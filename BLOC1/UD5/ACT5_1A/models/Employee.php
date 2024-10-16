<?php

    namespace models;

    class Employee extends Model {
        // Definir la taula associada a la classe
        protected static $table = 'employees';

	    // Constructor opcional
		public function __construct(    
			public $employee_id=null,
			public $first_name=null,
			public $last_name=null,
			public $email=null,
			public $phone_number=null,
			public $hire_date=null,
			public $job_id=null,
			public $salary=null,
			public $commission_pct=null,
			public $manager_id=null,
			public $department_id=null ) { }
		}

?>