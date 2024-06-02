<?php

namespace App\Services\Notes;
use App\Models\Note;

class Core 
{   
    public function getList(array $params = []): array
    {
        $ents = Note::where('user_id', auth()->user()->id)->get();

        return $ents->toArray();
    }

    public function getItem(int $id): array
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        return $ent->toArray();       
    }

    public function create(array $data): Array
    {
        $data = array_merge($data, [    
            'user_id' => auth()->user()->id
        ]);

        if (!$ent = Note::create($data)) {
            new \Exception('Not saved!');
        }

        return $ent->toArray();
    }

    public function update(int $id, array $data)
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        if (!$ent->update($data)) {
            new \Exception('Not updated!');
        }
    }

    public function delete(int $id)
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        if (!$ent->delete()) {
            new \Exception('Not deleted!');
        }
    }
}