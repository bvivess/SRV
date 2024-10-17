<?php

    namespace models;

    class Employee extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'employees';

	    // Constructor
		public function __construct(    
			public int $employee_id,
			public ?string $first_name=null,
			public ?string $last_name=null,
			public ?string $email=null,
			public ?string $phone_number=null,
			public ?string $hire_date=null,
			public ?string $job_id=null,
			public ?float $salary=null,
			public ?float $commission_pct=null,
			public ?int $manager_id=null,
			public ?int $department_id=null
		) { }
	
	}

?>