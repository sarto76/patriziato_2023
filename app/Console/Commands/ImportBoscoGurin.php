<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportBoscoGurin extends Command
{
    protected $signature = 'import:bosco_gurin';
    protected $description = 'Importa i dati da bosco_gurin a patriziato';

    public function handle()
    {
        $this->info('Inizio import da bosco_gurin...');

        // Connessione al DB bosco_gurin
        $sourceDB = DB::connection('bosco_gurin'); // se vuoi usare un altro DB config, puoi definire una connessione separata

        try {
            // 1️⃣ Resetta ID in bosco_gurin (opzionale, se vuoi solo leggere puoi saltare)
            $sourceDB->statement("SET FOREIGN_KEY_CHECKS = 0");
            $sourceDB->statement("SET @nuovo_id = 0");
            $sourceDB->statement("UPDATE patrizio SET id = (@nuovo_id := @nuovo_id + 1)");
            $sourceDB->statement("ALTER TABLE patrizio AUTO_INCREMENT = 1");
            $sourceDB->statement("SET FOREIGN_KEY_CHECKS = 1");

            $this->info('Reset ID completato.');

            // 2️⃣ Leggi dati da bosco_gurin
            $dati = $sourceDB->table('patrizio')->get();

            // 3️⃣ Svuota le tabelle di destinazione
            DB::table('relations')->truncate();
            DB::table('patrizi')->truncate();
            $this->info('Tabelle patrizi e relations truncate.');

            // 4️⃣ Inserimento dati
            foreach ($dati as $record) {

                $birth = $record->data_nascita ?: '1900-01-01';
                $death = $record->data_morte ?: '1900-01-01';
                $lost = $record->data_perdita_patrizio ?: '1900-01-01';
                $register_number = $record->no_registro ?: '99999';
                $nap = $record->nap ?: 0;

                // Inserimento patrizio
                $patrizioId = DB::table('patrizi')->insertGetId([
                    'register_number' => $register_number,
                    'firstname' => $record->nome,
                    'lastname' => $record->cognome,
                    'birth' => $birth,
                    'living' => $record->vivente,
                    'death' => $death,
                    'patriziato_lost' => $lost,
                    'phone' => $record->telefono,
                    'email' => $record->email,
                    'street' => $record->via,
                    'zip' => $nap,
                    'city' => $record->localita,
                    'picture' => $record->foto,
                    'note' => '',
                    'password' => $record->password,
                    'confirmed' => $record->confermato,
                ]);

                // 5️⃣ Relazioni padre/madre
                $padreId = null;
                $madreId = null;

                // Padre
                if (!empty($record->padre)) {
                    [$cognomePadre, $nomePadre] = explode(' ', trim($record->padre)) + [null, null];

                    $padre = $dati->first(function($r) use ($cognomePadre, $nomePadre) {
                        return strtolower(trim($r->cognome)) === strtolower(trim($cognomePadre))
                            && strtolower(trim($r->nome)) === strtolower(trim($nomePadre));
                    });

                    if ($padre) {
                        $padreId = $padre->id;
                        DB::table('relations')->insert([
                            'patrizio1_id' => $padre->id,
                            'patrizio2_id' => $record->id,
                            'type' => 'father'
                        ]);
                        $this->info("Relazione padre aggiunta: {$padre->nome} {$padre->cognome} -> {$record->nome} {$record->cognome}");
                    }
                }

                // Madre
                if (!empty($record->madre)) {
                    [$cognomeMadre, $nomeMadre] = explode(' ', trim($record->madre)) + [null, null];

                    $madre = $dati->first(function($r) use ($cognomeMadre, $nomeMadre) {
                        return strtolower(trim($r->cognome)) === strtolower(trim($cognomeMadre))
                            && strtolower(trim($r->nome)) === strtolower(trim($nomeMadre));
                    });

                    if ($madre) {
                        $madreId = $madre->id;
                        DB::table('relations')->insert([
                            'patrizio1_id' => $madre->id,
                            'patrizio2_id' => $record->id,
                            'type' => 'mother'
                        ]);
                        $this->info("Relazione madre aggiunta: {$madre->nome} {$madre->cognome} -> {$record->nome} {$record->cognome}");
                    }
                }

                // Spouse
                if ($padreId && $madreId) {
                    DB::table('relations')->insert([
                        'patrizio1_id' => $padreId,
                        'patrizio2_id' => $madreId,
                        'type' => 'spouse'
                    ]);
                    $this->info("Relazione spouse aggiunta tra padre {$padreId} e madre {$madreId}");
                }
            }

            $this->info('Import completato con successo!');

        } catch (\Exception $e) {
            $this->error('Errore durante l’import: ' . $e->getMessage());
        }


        $this->info('Inizio procedura di estrazione immagini...');

        // 1️⃣ Pulizia preventiva della cartella di destinazione
        $directory = 'private/documents'; // Sottocartella per tenere ordinato
        if (Storage::disk('local')->exists($directory)) {
            $this->warn("Pulizia cartella esistente: storage/app/{$directory}");
            Storage::disk('local')->deleteDirectory($directory);
        }
        Storage::disk('local')->makeDirectory($directory);

        // 2️⃣ Estrazione da tabella 'docs' (colonna 'content')
        $this->info('Estrazione da tabella: docs...');
        DB::connection('bosco_gurin')->table('docs')
            ->whereNotNull('content')
            ->orderBy('id')
            ->chunk(100, function ($docs) use ($directory) {
                foreach ($docs as $doc) {
                    $filename = "doc_{$doc->id}.pdf"; // Estensione presunta, cambiala se sai che sono PDF
                    Storage::disk('local')->put($directory . '/' . $filename, $doc->content);

                    // Opzionale: aggiorna il nuovo DB qui se necessario
                    $this->info("Salvato documento: {$filename}");
                }
            });

        // 3️⃣ Estrazione da tabella 'prop_media' (colonna 'datas')
        $this->info('Estrazione da tabella: prop_media...');
        DB::connection('bosco_gurin')->table('prop_media')
            ->whereNotNull('datas')
            ->orderBy('idprop_media')
            ->chunk(100, function ($media) use ($directory) {
                foreach ($media as $m) {
                    $filename = "media_{$m->idprop_media}.png";
                    Storage::disk('local')->put($directory . '/' . $filename, $m->datas);

                    $this->info("Salvato media: {$filename}");
                }
            });

        $this->info('Importazione file fisici completata con successo!');


    }
}
