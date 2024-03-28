<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ArtistInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtistRequest;
use App\Traits\AdminMethods;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    use AdminMethods;

    private $page = "artist.";
    private $redirectTo = "admin.artist.index";

    protected $artistRepository;

    public function __construct(ArtistInterface $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    public function index()
    {
        $artists = $this->artistRepository->getAll();
        return $this->view($this->page . "index", [
            "artists" => $artists
        ])->with("id");
    }

    public function create()
    {
        return $this->view($this->page . "create");
    }

    public function store(ArtistRequest $request)
    {
        try {
            DB::beginTransaction();
            $artist = $this->artistRepository->save($request);
            DB::commit();
            return $this->successMsgAndRedirect("Artist created successfully", $this->redirectTo);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    public function edit($id)
    {
        $artist = $this->artistRepository->findOrFail($id);
        return $this->view($this->page . "edit", [
            "artist" => $artist
        ]);
    }

    public function update(ArtistRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $artist = $this->artistRepository->update($request, $id);
            DB::commit();
            return $this->successMsgAndRedirect('Artist updated successfully', $this->redirectTo);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $artist = $this->artistRepository->delete($id);
            DB::commit();
            return $this->successMsgAndRedirect('Artist deleted', $this->redirectTo);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }
}
