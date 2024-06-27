<?php
namespace Nurdin\Mind\Service;

use Nurdin\Mind\Model\Suggestion\SuggestionsAddRequest;
use Nurdin\Mind\Model\Suggestion\SuggestionsAddResponse;
use Nurdin\Mind\Repository\SuggestionsRepository;
use Exception;
use Nurdin\Mind\Config\DatabaseConfig;
use Nurdin\Mind\Domain\Suggestions;
use Nurdin\Mind\Model\Suggestion\SuggestionsDeleteRequest;
use Nurdin\Mind\Model\Suggestion\SuggestionsDisplayResponse;

class SuggestionsService{
    private SuggestionsRepository $suggestionsRepo;

    public function __construct(SuggestionsRepository $suggestionsRepo)
    {
        $this->suggestionsRepo = $suggestionsRepo;
    }

    public function addSuggestion(SuggestionsAddRequest $request) : SuggestionsAddResponse
    {
        try{
            DatabaseConfig::beginTransaction();
            $suggestions = new Suggestions();
            $suggestions->id = uniqid();
            $suggestions->email = $request->email;
            $suggestions->name = $request->name;
            $suggestions->message = $request->message;
            $this->suggestionsRepo->insert($suggestions);
            DatabaseConfig::commitTransaction();

            $response = new SuggestionsAddResponse();
            $response->suggestions = $suggestions;

            return $response;
        } catch(Exception $e){
            DatabaseConfig::rollbackTransaction();
        }
    }

    public function displayAll() : SuggestionsDisplayResponse
    {
        try{
            $suggestions = $this->suggestionsRepo->findAll();
            if($suggestions == null){
                throw new Exception("Tidak ada pesan untuk anda");
            }

            $response = new SuggestionsDisplayResponse();
            $response->suggestions = $suggestions;

            return $response;
        } catch (Exception $e){
            throw $e;
        }
    }

    public function deleteById(SuggestionsDeleteRequest $request)
    {
        try{
            DatabaseConfig::beginTransaction();
            $suggestions = $this->suggestionsRepo->findById($request->id);
            if($suggestions == null){
                throw new Exception("Pesan tidak ditemukan");
            }

            $this->suggestionsRepo->deleteById($request->id);
            DatabaseConfig::commitTransaction();
        } catch(Exception $e){
            throw $e;
        }
    }

}