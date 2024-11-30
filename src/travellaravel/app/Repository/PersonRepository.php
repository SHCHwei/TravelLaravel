<?php


namespace App\Repository;


class PersonRepository extends BaseRepository
{

    public function nameFormater(string $name) : bool
    {

        if( !preg_match('/^([A-Z][a-z]*)(\s[A-Z][a-z]*)*$/', $name) ){
            return true;
        }

        return false;
    }

}
