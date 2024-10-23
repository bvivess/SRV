<?php

    namespace models;

    class Customer extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'customers';

	    // Constructor opcional
		public function __construct(    
			public int $customer_id,
			public ?string $cust_first_name=null,
            public ?string $cust_last_name=null,
			public ?string $cust_street_address=null,
			public ?string $cust_postal_code=null,
			public ?string $cust_city=null,
            public ?string $cust_state=null,
            public ?string $cust_country=null,
            public ?string $phone_numbers=null,
            public ?string $nls_language=null,
            public ?string $nls_territory=null,
            public ?float $credit_limit=null,
            public ?string $cust_email=null,
            public ?int $account_mgr_id=null,
            public ?string $cust_geo_location=null,
            public ?string $date_of_birth=null,
            public ?string $marital_status=null,
            public ?string $gender=null, 
            public ?string $income_level=null ) { }
		}

?>