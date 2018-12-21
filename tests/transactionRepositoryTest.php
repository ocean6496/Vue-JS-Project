<?php

use App\Models\transaction;
use App\Repositories\transactionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class transactionRepositoryTest extends TestCase
{
    use MaketransactionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var transactionRepository
     */
    protected $transactionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->transactionRepo = App::make(transactionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetransaction()
    {
        $transaction = $this->faketransactionData();
        $createdtransaction = $this->transactionRepo->create($transaction);
        $createdtransaction = $createdtransaction->toArray();
        $this->assertArrayHasKey('id', $createdtransaction);
        $this->assertNotNull($createdtransaction['id'], 'Created transaction must have id specified');
        $this->assertNotNull(transaction::find($createdtransaction['id']), 'transaction with given id must be in DB');
        $this->assertModelData($transaction, $createdtransaction);
    }

    /**
     * @test read
     */
    public function testReadtransaction()
    {
        $transaction = $this->maketransaction();
        $dbtransaction = $this->transactionRepo->find($transaction->id);
        $dbtransaction = $dbtransaction->toArray();
        $this->assertModelData($transaction->toArray(), $dbtransaction);
    }

    /**
     * @test update
     */
    public function testUpdatetransaction()
    {
        $transaction = $this->maketransaction();
        $faketransaction = $this->faketransactionData();
        $updatedtransaction = $this->transactionRepo->update($faketransaction, $transaction->id);
        $this->assertModelData($faketransaction, $updatedtransaction->toArray());
        $dbtransaction = $this->transactionRepo->find($transaction->id);
        $this->assertModelData($faketransaction, $dbtransaction->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetransaction()
    {
        $transaction = $this->maketransaction();
        $resp = $this->transactionRepo->delete($transaction->id);
        $this->assertTrue($resp);
        $this->assertNull(transaction::find($transaction->id), 'transaction should not exist in DB');
    }
}
