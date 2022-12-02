<?php

$config = array(
	'signup' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Name can not be empty',
			)
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]',
			'errors' => array(
				'required'		=> 'Email can not be empty',
				'valid_email'	=> 'Enter valid email address',
				'is_unique'		=> 'This email already registered with us',
			)
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Password can not be empty'
			)
		),
		array(
			'field' => 'confPassword',
			'label' => 'Confirm Password',
			'rules' => 'trim|required|matches[password]',
			'errors' => array(
				'required' => 'Confirm Password can not be empty',
				'matches' => 'Password did not match.',
			)
		),
		array(
			'field' => 'termsAndCondition',
			'label' => 'Terms and Condition',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Accept terms and condition',
			)
		),
	),
	'signup_api' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Name can not be empty',
			)
		),
		array(
			'field' => 'mobile',
			'label' => 'Mobile',
			'rules' => 'trim|required|is_unique[users.mobile]',
			'errors' => array(
				'required' => 'Mobile can not be empty',
				'is_unique'		=> 'This mobile already registered with us',
			)
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|is_unique[users.email]',
			'errors' => array(
				'required'		=> 'Email can not be empty',
				'valid_email'	=> 'Enter valid email address',
				'is_unique'		=> 'This email already registered with us',
			)
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Password can not be empty'
			)
		)
	),
	'signin' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email',
			'errors' => array(
				'required'		=> 'Email can not be empty',
				'valid_email'	=> 'Enter valid email address'
			)
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Password can not be empty'
			)
		),
		array(
			'field' => 'device_id',
			'label' => 'Device ID',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Device ID can not be empty'
			)
		),
		array(
			'field' => 'device_type',
			'label' => 'Device Type',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Device Type can not be empty'
			)
		),
	),
	'forgot' => array(
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email',
			'errors' => array(
				'required'		=> 'Email can not be empty',
				'valid_email'	=> 'Enter valid email address'
			)
		),
	),
	'reset' => array(
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Password can not be empty'
			)
		),
		array(
			'field' => 'confPassword',
			'label' => 'Confirm Password',
			'rules' => 'trim|required|matches[password]',
			'errors' => array(
				'required' => 'Confirm Password can not be empty',
				'matches' => 'Password did not match.',
			)
		),
	),
	'change_password' => array(
		array(
			'field' => 'old_password',
			'label' => 'Old password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Old password can not be empty'
			)
		),
		array(
			'field' => 'new_password',
			'label' => 'New password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'New password can not be empty'
			)
		),
		array(
			'field' => 'conf_password',
			'label' => 'Confirm password',
			'rules' => 'trim|required|matches[new_password]',
			'errors' => array(
				'required' => 'Confirm password can not be empty',
				'matches' => 'Password did not match.',
			)
		),
	),
	'change_password' => array(
		array(
			'field' => 'token',
			'label' => 'Token',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Confirm password can not be empty'
			)
		),
		array(
			'field' => 'old_password',
			'label' => 'Old password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Old password can not be empty'
			)
		),
		array(
			'field' => 'new_password',
			'label' => 'New password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'New password can not be empty'
			)
		),
	),
	'profile_update' => array(
		array(
			'field' => 'name',
			'label' => 'Old name',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Name can not be empty'
			)
		),
		array(
			'field' => 'dob_month',
			'label' => 'DOB Month',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'DOB Month can not be empty'
			)
		),
		array(
			'field' => 'dob_date',
			'label' => 'Dob Date',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Dob Date can not be empty',
			)
		),
		array(
			'field' => 'dob_year',
			'label' => 'DOB Year',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'DOB Year can not be empty',
			)
		),
		array(
			'field' => 'addr_1',
			'label' => 'Address 1',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Address 1 can not be empty',
			)
		),
		array(
			'field' => 'addr_2',
			'label' => 'Address 2',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Address 2 can not be empty',
			)
		),
		array(
			'field' => 'city',
			'label' => 'City',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'City can not be empty',
			)
		),
		array(
			'field' => 'zipcode',
			'label' => 'Zip Code',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Zip Code can not be empty',
			)
		),
		array(
			'field' => 'country',
			'label' => 'Country',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Country can not be empty',
			)
		),
	),
	'admin_login' => array(
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Username can not be empty'
			)
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required',
			'errors' => array(
				'required' => 'Password can not be empty'
			)
		),
	),
	'mobile_verify' => array(
		array(
			'field' => 'mobile',
			'label' => 'Mobile',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Mobile can not be empty'
			)
		),
	),
	'mobile_verify_api' => array(
		array(
			'field' => 'mobile',
			'label' => 'Mobile',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Mobile can not be empty'
			)
		),
		array(
			'field' => 'token',
			'label' => 'Token',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Token can not be empty'
			)
		),
	),
	'otp_verify_api' => array(
		array(
			'field' => 'token',
			'label' => 'Token',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Token can not be empty'
			)
		),
	),
	'bank_detail'	=> array(
		array(
			'field' => 'ac_holder',
			'label' => 'Account Holder Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Account holder name can not be empty'
			)
		),
		array(
			'field' => 'bank_name',
			'label' => 'Bank Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Bank name can not be empty'
			)
		),
		array(
			'field' => 'ac_number',
			'label' => 'Account Number',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Account number can not be empty'
			)
		),
		array(
			'field' => 'swift_code',
			'label' => 'Swift code',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Swift code can not be empty'
			)
		),
	),
	'bank_detail_api'	=> array(
		array(
			'field' => 'token',
			'label' => 'Token',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Token can not be empty'
			)
		),
		array(
			'field' => 'ac_holder',
			'label' => 'Account Holder Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Account holder name can not be empty'
			)
		),
		array(
			'field' => 'bank_name',
			'label' => 'Bank Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Bank name can not be empty'
			)
		),
		array(
			'field' => 'ac_number',
			'label' => 'Account Number',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Account number can not be empty'
			)
		),
		array(
			'field' => 'swift_code',
			'label' => 'Swift code',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Swift code can not be empty'
			)
		),
	),
	'doc_upload' => array(
		array(
			'field' => 'passport',
			'label' => 'Passport',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please select passport'
			)
		),
		array(
			'field' => 'driving_licence',
			'label' => 'Driving Licence',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please select driving licence'
			)
		),
		array(
			'field' => 'utility_bill',
			'label' => 'Utility Bill',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please select utility bill'
			)
		),
		array(
			'field' => 'bank_statement',
			'label' => 'Bank Statement',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please select bank statement'
			)
		),
	),
	'membership' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please enter membership plan name'
			)
		),
		array(
			'field' => 'amount',
			'label' => 'Amount',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please enter membership amount'
			)
		),
		array(
			'field' => 'month',
			'label' => 'Month',
			'rules' => 'trim|required',
			'errors' => array(
				'required'		=> 'Please enter membership month'
			)
		),
	),
	'dpst_wtdrwl' => array(
		array(
			'field' => 'amount',
			'label' => 'Amount',
			'rules' => 'trim|required|greater_than_equal_to[500]',
			'errors' => array(
				'required'		=> 'Please enter amount',
				'greater_than_equal_to' => 'Minimum amount is 500 GBP'
			)
		),
	),
	'tfa' => array(
		array(
			'field' => 'code',
			'label' => 'Code',
			'rules' => 'trim|required',
			'errors' => array(
				'required'	=> 'Please enter 2FA code'
			)
		),
	),
	'transaction_pin' => array(
		array(
			'field' => 'pin',
			'label' => 'Pin',
			'rules' => 'trim|required|min_length[6]|max_length[6]',
			'errors' => array(
				'required'	=> 'Please enter Pin'
			)
		),
	),
	'buy_sell_currency' => array(
		array(
			'field' => 'amt',
			'label' => 'Amount',
			'rules' => 'trim|required',
			'errors' => array(
				'required'	=> 'Amount can not be empty'
			)
		),
		array(
			'field' => 'gbp',
			'label' => 'GBP',
			'rules' => 'trim|required',
			'errors' => array(
				'required'	=> 'GBP can not be empty'
			)
		),
	),
	'send_currency' => array(
		array(
			'field' => 'address',
			'label' => 'Address',
			'rules' => 'trim|required',
			'errors' => array(
				'required'	=> 'Address can not be empty'
			)
		),
		array(
			'field' => 'amt',
			'label' => 'Amount',
			'rules' => 'trim|required',
			'errors' => array(
				'required'	=> 'Amount can not be empty'
			)
		),
	),
);