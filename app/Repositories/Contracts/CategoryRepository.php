<?php

namespace App\Repositories\Contracts;

interface CategoryRepository
{
    public function all($paginate = 10);

    public function store($data);

    public function show($id);

    public function update($data, $id);

    public function destroy($id);
}