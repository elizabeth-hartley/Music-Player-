<?php

namespace CodersCanine\ArtistHydrator;
use CodersCanine\Artist\Artist;
use PDO;

class ArtistHydrator
{
    private static PDO $db;
    public static function getArtists (): array
    {
        $query = ArtistHydrator::$db->prepare('SELECT `id`, `artist_name` AS `name` FROM `artists`');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        return $query->fetchAll();
    }

    public static function getSpecificArtist (string $artistName): array
    {
        $query = ArtistHydrator::$db->prepare('SELECT `id`, `artist_name` AS `name` FROM `artists` WHERE `artist_name` = ?');
        $query->execute([$artistName]);
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        return $query->fetch();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }

}