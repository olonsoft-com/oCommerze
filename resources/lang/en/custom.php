<?php

return [

    'status'=>[
        'success' => '200',
        'failed' => '401',
        'noData' => '404',
        'validError' => '406',
        'dbInsertError' => '400',
        'ServiceUnavailAble' => '503',
        'internalError' => '500',
        'conflict' => '409',
        'expectFailed' => '417',
        'preconRequired' => '428',
        'NotSatisfy' => '416',
        'unavailableLegalRes'=>'451',
    ],
    'activity'=>[
        'main_balance_currency_entry' => 'main_balance_currency_entry',
    ],

    'msg'=>[
        'invalid'=>'Invalid request. Something wrong, please try again.',
        'wrongCred'=>'Username or password wrong. Please check and try again.',
        'deactiveShop'=>'Shop not authorized yet. Please check and try again.',
        'dataSuccess'=>'Data create successfully',
        'dataUpdate'=>'Data update successfully',
        'dataGet'=>'Data get successfully',
        'dataExist'=>'Data already exist or duplicate entry. Please try later.',
        'dataInsertFail'=>'Data insert failed. Please try later.',
        'noData'=>'No data found.Please try later.',
        'validError'=>'Validation error',
        'notEnoughAmount'=>'Not enough amount in balance. Please recharge your wallet.',
        'topUpFailed'=>'Top up failed. Please try later.',
        'ServiceUnavailAble'=>'Service unavailable at this moment. Please try later.', // opertator domain response issue
        'wrong'=>'Something wrong, Please try later.',
        'topUpSuccess'=>'Top up successfully.',
        'walletInfo'=>'Wallet info get successfully.',
        'getLatestInfo'=>'Get latest transactions mobile successfully.',
        'getWalletTrans'=>'Get latest wallet mobile transactions.',
        'editFailed'=>'Profile photo upload failed. Please try again.',
        'usernamePassNo'=>'Wrong username or password . Please try again.',
        'customProdCrt'=>'Create product successfully',
        'userEditFailed'=>'User edit failed',
        'userActive'=>'User active successfully.',
        'userDecActive'=>'User deactive successfully.',
        'contactAdmin'=>'Activate your shop account, please try later',
        'activateAccnt'=>'Activate your account first, contact to administrator. please try later',
        'mailSend'=>'A email sent to your inbox. Please check.',
        'mailSendAlready'=>'Already a token sent to your email. please check.',
        'passChange'=>'Password change successfully.',
        'cstmCrncyChange'=>'Custom currency updated successfully.',
        'topUpFailedOper'=>'Wrong operator, please try again.',
        'spaSyNoBalance'=>'Not have enough balance. Please contact with administrator.',
        'dbInsertError'=>'Something wrong, Please try again.',
        'FailedMsg'=>'Something wrong, Please try again.',
        'topUpFailedSms'=>'Failed top up.',
        'mainAccountNoFund'=>'Service not available. Please contact with administrator. ID: OG0000113', // when spaysy top up not ok
        'pinResend'=>'Pin resend successfully.',
        'prodExist'=>'Product already exist.',
        'prodDelt'=>'Comission product delete.',
        'vocherNotExist'=>'Voucher already used or not exist. Please check and try again.',
        'permission'=>'No permission found. Please check and try again.',
        'NotTransToken'=>'Trans token not valid. Please check and try again.',
        'spaysyAccountUpdate'=>'Spaysy account password  need to update. Please check.', // password or invalid credential problem
        'spaysyNoBalance'=>'Spaysy account has no balance. Please check.', // fund issue
        'tokenReqInvalid'=>'Invalid transaction request. Please check and try again.', // fund issue
        'getBdProdCrncy'=>'Get BD product one currecny details successfully.', // fund issue
        'notValid'=>'data not valid. please try again.',
        'BDProdOneProb'=>'BD product one account has no balance. Please check.',
        'BDProdOneTransFail'=>'Transaction failed. Something went wrong, please try again.',
        'topUpTransFail'=>'Transaction failed. Something went wrong, please try again.',
        'bdProdOneCrncy'=>'Need to set currency or something went wrong, please try again.',
        'SpaysyAccountOk'=>'No problem found. Spaysy account looks ok.',
        'bdOneAccountOk'=>'No problem found. BD product one account looks ok.',
        'alreadyRefund'=>'Already refunded. Please contact with administrator.',
        'refundSuccess'=>'Refund successfully transferred.',
        'msgSend'=>'Message send successfully.',


    ],
    'const'=>[
        'tranxId'=> strtoupper(uniqid().rand(111,999)),
        'randGenID'=> strtoupper(time().uniqid().time().rand(111,999)),
    ]



];