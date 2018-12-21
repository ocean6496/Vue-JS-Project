<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetransactionAPIRequest;
use App\Http\Requests\API\UpdatetransactionAPIRequest;
use App\Models\transaction;
use App\Repositories\transactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class transactionController
 * @package App\Http\Controllers\API
 */

class transactionAPIController extends AppBaseController
{
    /** @var  transactionRepository */
    private $transactionRepository;

    public function __construct(transactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * Display a listing of the transaction.
     * GET|HEAD /transactions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->transactionRepository->pushCriteria(new RequestCriteria($request));
        $this->transactionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $transactions = $this->transactionRepository->all();

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }

    /**
     * Store a newly created transaction in storage.
     * POST /transactions
     *
     * @param CreatetransactionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetransactionAPIRequest $request)
    {
        $input = $request->all();

        $transactions = $this->transactionRepository->create($input);

        return $this->sendResponse($transactions->toArray(), 'Transaction saved successfully');
    }

    /**
     * Display the specified transaction.
     * GET|HEAD /transactions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var transaction $transaction */
        $transaction = $this->transactionRepository->findWithoutFail($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse($transaction->toArray(), 'Transaction retrieved successfully');
    }

    /**
     * Update the specified transaction in storage.
     * PUT/PATCH /transactions/{id}
     *
     * @param  int $id
     * @param UpdatetransactionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetransactionAPIRequest $request)
    {
        $input = $request->all();

        /** @var transaction $transaction */
        $transaction = $this->transactionRepository->findWithoutFail($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction = $this->transactionRepository->update($input, $id);

        return $this->sendResponse($transaction->toArray(), 'transaction updated successfully');
    }

    /**
     * Remove the specified transaction from storage.
     * DELETE /transactions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var transaction $transaction */
        $transaction = $this->transactionRepository->findWithoutFail($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendResponse($id, 'Transaction deleted successfully');
    }
}
