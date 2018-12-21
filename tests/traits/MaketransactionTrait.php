<?php

use Faker\Factory as Faker;
use App\Models\transaction;
use App\Repositories\transactionRepository;

trait MaketransactionTrait
{
    /**
     * Create fake instance of transaction and save it in database
     *
     * @param array $transactionFields
     * @return transaction
     */
    public function maketransaction($transactionFields = [])
    {
        /** @var transactionRepository $transactionRepo */
        $transactionRepo = App::make(transactionRepository::class);
        $theme = $this->faketransactionData($transactionFields);
        return $transactionRepo->create($theme);
    }

    /**
     * Get fake instance of transaction
     *
     * @param array $transactionFields
     * @return transaction
     */
    public function faketransaction($transactionFields = [])
    {
        return new transaction($this->faketransactionData($transactionFields));
    }

    /**
     * Get fake data of transaction
     *
     * @param array $postFields
     * @return array
     */
    public function faketransactionData($transactionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'currency_id' => $fake->word,
            'dated' => $fake->word,
            'active' => $fake->word,
            'amount' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $transactionFields);
    }
}
