<?php

namespace App\Services\Notes;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Models\Note;

class Core 
{   
    /**
     * Получение списка
     * @param array $params
     * @return array
     */
    public function getList(array $params = []): array
    {
        $ents = Note::where('user_id', auth()->user()->id)->get();

        return $ents->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getItem(int $id): array
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        return $ent->toArray();       
    }

    /**
     * @param array $data
     * @return array
     * @throws BadRequestHttpException
     */
    public function create(array $data): array
    {
        $data = array_merge($data, [    
            'user_id' => auth()->user()->id
        ]);

        if (!$ent = Note::create($data)) {
            throw new BadRequestHttpException('При сохранении произошла ошибка.');
        }

        return ['redirect' => route('home'), 'item' => $ent];
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     * @throws BadRequestHttpException
     */
    public function update(int $id, array $data): array
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        if (!$ent->update($data)) {
            throw new BadRequestHttpException('При сохранении произошла ошибка.');
        }

        return ['redirect' => route('home')];
    }

    /**
     * @param int $id
     * @return void
     * @throws BadRequestHttpException
     */
    public function delete(int $id): void
    {
        $ent = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        if (!$ent->delete()) {
            throw new BadRequestHttpException('При удалении произошла ошибка.');
        }
    }
}