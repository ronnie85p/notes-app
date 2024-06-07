<?php

namespace App\Services\Notes;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Support\Facades\Gate;
use App\Models\Note;
use App\Policies\NotesPolicy;

class NotesService
{   
    static public function addPolicies()
    {
        Gate::policy(Note::class, NotesPolicy::class);
    }

    /**
     * Получение списка
     * @param array $params
     * @return array
     */
    public function getList($user, array $params = []): array
    {
        $ents = Note::where('user_id', $user->id)->get();

        return $ents->toArray();
    }

    /**
     * Получение записи
     * @param int $id
     * @return array
     */
    public function getItem($user, int $id): array
    {
        $ent = Note::where('user_id', $user->id)->findOrFail($id);

        return $ent->toArray();       
    }

    /**
     * Создание записи
     * @param array $data
     * @return array
     * @throws BadRequestHttpException
     */
    public function create($user, array $data): array
    {
        Gate::authorize('create');

        $data = array_merge($data, [    
            'user_id' => $user->id
        ]);

        if (!$ent = Note::create($data)) {
            throw new BadRequestHttpException('При сохранении произошла ошибка.');
        }

        return ['redirect' => route('home'), 'item' => $ent];
    }

    /**
     * Обновление записи
     * @param int $id
     * @param array $data
     * @return array
     * @throws BadRequestHttpException
     */
    public function update($user, int $id, array $data): array
    {
        $ent = Note::where('user_id', $user->id)->findOrFail($id);
        
        if (!$ent->update($data)) {
            throw new BadRequestHttpException('При сохранении произошла ошибка.');
        }

        return ['redirect' => route('home')];
    }

    /**
     * Удаление записи
     * @param int $id
     * @return void
     * @throws BadRequestHttpException
     */
    public function delete($user, int $id): void
    {
        $ent = Note::where('user_id', $user->id)->findOrFail($id);

        if (!$ent->delete()) {
            throw new BadRequestHttpException('При удалении произошла ошибка.');
        }
    }
}