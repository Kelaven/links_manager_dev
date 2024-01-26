<?php

require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../helpers/Database.php';



// ! création de la classe
class Link
{

    // ! création des attributs
    private ?int $link_id;
    private string $title;
    private string $url;

    // ! création de la méthode magique __construct
    public function __construct(?int $link_id = NULL, string $title = '', string $url = '')
    {
        $this->link_id = $link_id;
        $this->title = $title;
        $this->url = $url;
    }

    // ! création du setter et getter de link_id
    public function setLinkId(int $link_id)
    {
        $this->link_id = $link_id;
    }
    public function getLinkId(): int
    {
        return $this->link_id;
    }
    // ! création du setter et getter de title
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    // ! création du setter et getter de url
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
    public function getUrl(): string
    {
        return $this->url;
    }

    // ! création de la méthode getAll
    /**
     * méthode qui retourne tous les liens
     * @return array
     */
    public static function getAll(): array
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `links`;';
        // $sql .= ' WHERE 1 = 1';

        $sth = $pdo->query($sql);

        $result = $sth->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    // ! création de la méthode get
    /**
     * méthode qui retourne le lien ciblé
     * @param int $link_id
     * 
     * @return object
     */
    public static function get(int $link_id): object|false
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `links`
        WHERE `link_id` = :link_id;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':link_id', $link_id, PDO::PARAM_INT);

        $result = $sth->execute();

        $result = $sth->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    // ! création de la méthode update
    /**
     * méthode pour modifier les données
     * @return [type]
     */
    public function update($link_id): bool
    {
        $pdo = Database::connect();

        $sql = 'UPDATE `links`
        SET `title` = :title, `url` = :url
        WHERE `link_id` = :link_id;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':title', $this->getTitle());
        $sth->bindValue(':url', $this->getUrl());
        $sth->bindValue(':link_id', $link_id, PDO::PARAM_INT);

        $result = $sth->execute();

        return $result; // retourne un bool indiquant le succès ou l'échec de la mise à jour
    }

    // ! création de la méthode insert
    /**
     * méthode pour insérer des données
     * @return bool
     */
    public function insert(): bool
    {
        $pdo = Database::connect();

        $sql = 'INSERT INTO `links` (title, url)
        VALUES (:title, :url);';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':title', $this->getTitle());
        $sth->bindValue(':url', $this->getUrl());

        $sth->execute(); // renvoi true si l'exécution est ok sinon false mais renverra true aussi si l'exécution est ok alors que peut être qu'aucune ligne n'a été insérée

        $result = $sth->rowCount(); // si l'exécution est ok et qu'une ligne a bien été insérée ça retournera 1 sinon 0

        return $result > 0 ? true : false;
    }

    // ! création de la méthode delete
    public static function delete(int $link_id)
    {
        $pdo = Database::connect();

        $sql = 'DELETE FROM `links`
        WHERE `link_id` = :link_id;';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':link_id', $link_id, PDO::PARAM_INT);

        $result = $sth->execute();

        return $result;
    }
}
