<?php
public function insertQandA(){
    try {

    }
    }        // Načítanie JSON súboru
        $data = json_decode(file_get_contents
        (__ROOT__.'/data/datas.json'), true);
$otazky = $data["otazky"];
$odpovede = $data["odpovede"];
// Vloženie otázok a odpovedí v rámci transakcie
        $this->conn->beginTransaction();

        $sql = "INSERT INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)";
        $statement = $this->conn->prepare($sql);

        for ($i = 0; $i < count($otazky); $i++) {
            $statement->bindParam(':otazka', $otazky[$i]);
            $statement->bindParam(':odpoved', $odpovede[$i]);
            $statement->execute();
        }
        $this->conn->commit();
        echo "Dáta boli vložené";
} catch (Exception $e) {
    // Zobrazenie chybového hlásenia
    echo "Chyba pri vkladaní dát do databázy: " . $e->getMessage();
    $this->conn->rollback(); // Vrátenie späť zmien v prípade chyby
} finally {
    // Uzatvorenie spojenia
    $this->conn = null;
}
}
}
}