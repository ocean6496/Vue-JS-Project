<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class transactionApiTest extends TestCase
{
    use MaketransactionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetransaction()
    {
        $transaction = $this->faketransactionData();
        $this->json('POST', '/api/v1/transactions', $transaction);

        $this->assertApiResponse($transaction);
    }

    /**
     * @test
     */
    public function testReadtransaction()
    {
        $transaction = $this->maketransaction();
        $this->json('GET', '/api/v1/transactions/'.$transaction->id);

        $this->assertApiResponse($transaction->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetransaction()
    {
        $transaction = $this->maketransaction();
        $editedtransaction = $this->faketransactionData();

        $this->json('PUT', '/api/v1/transactions/'.$transaction->id, $editedtransaction);

        $this->assertApiResponse($editedtransaction);
    }

    /**
     * @test
     */
    public function testDeletetransaction()
    {
        $transaction = $this->maketransaction();
        $this->json('DELETE', '/api/v1/transactions/'.$transaction->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/transactions/'.$transaction->id);

        $this->assertResponseStatus(404);
    }
}
