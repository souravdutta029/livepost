<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes){
            $created = Post::query()->create([
                'title' => data_get($attributes, 'title', 'Untitled'),
                'body' => data_get($attributes, 'body'),
            ]);

            if($userIds = data_get($attributes, 'user_ids')){
                $created->users()->sync($userIds);
            }
            return $created;
        });
    }

    /**
     * @param Post $post
     * @param array $attibutes
     * @return mixed
     */
    public function update(Post $post, array $attibutes)
    {
        return DB::transaction(function () use($post, $attibutes){
            $updated = $post->update([
                'title' => data_get($attibutes, 'title', $post->title),
                'body' => data_get($attibutes, 'body', $post->body),
            ]);

            if(!$updated){
                throw new \Exception('Failed to update the post');
            }

            if($userIds = data_get($attibutes, 'user_ids')){
                $post->users()->sync($userIds);
            }

            return $post;
        });
    }

    /**
     * @param Post $post
     * @return mixed
     */
    public function forceDelete(Post $post)
    {
        return DB::transaction(function () use($post){
            $deleted = $post->forceDelete();

            if(!$deleted){
                throw new \Exception('Cannot delete the post');
            }

            return $deleted;
        });
    }
}
