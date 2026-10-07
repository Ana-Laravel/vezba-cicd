<?php
// Povezivanje na privremenu bazu
$db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=jackpot', 'root', 'tajna');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function provera($uslov, $poruka) {
    if ($uslov) {
        echo "✅ $poruka\n";
    } else {
        echo "❌ $poruka\n";
        exit(1);
    }
}

// Test 1: novi igrač
$db->exec("INSERT INTO igraci (ime, stanje, email) VALUES ('Ana', 100, 'ana@primer.com')");
$broj = $db->query("SELECT COUNT(*) FROM igraci")->fetchColumn();
provera($broj == 1, "Igrač je upisan u bazu");

// Test 2: uplata
$db->exec("UPDATE igraci SET stanje = stanje + 50 WHERE ime = 'Ana'");
$stanje = $db->query("SELECT stanje FROM igraci WHERE ime = 'Ana'")->fetchColumn();
provera($stanje == 150, "Uplata od 50 je dodata (stanje: $stanje)");

// Test 3: migracija 002 je odradila posao
$email = $db->query("SELECT email FROM igraci WHERE ime = 'Ana'")->fetchColumn();
provera($email == 'ana@primer.com', "Kolona email postoji i radi");

echo "\n🎉 Svi testovi su prošli!\n";
