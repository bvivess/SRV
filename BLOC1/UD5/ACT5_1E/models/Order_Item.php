<?php

	namespace models;

	use config\Database;

    class Order_Item extends Model {
		// Definir la taula associada a la classe
		protected static $table = 'order_items';

			// Constructor
			public function __construct(    
				public ?int $order_id=null,
				public ?int $product_id=null,
				public ?int $line_item_id=null,
                public ?float $unit_price=null,
                public ?float $quantity=null
			) { }
		// Mètode per guardar l'empleat a la base de dades
		public function save() {
			error_reporting(E_ALL);
			try {
				// Connectar a la base de dades
				$conn = new Database();
				$conn->connectDB('C:/temp/config.db');
				//$db->conn->autocommit(false);
				//$db->conn->begin_transaction();

				// Obtenir el nom de la taula de la classe filla
				$table = static::$table; 

				// Connectar a la base de dades
				if (isset($this->order_id)) {
					// Preparar l'INSERT / UPDATE
					$sql = "INSERT INTO $table (order_id, product_id, line_item_id, unit_price, quantity) 
							VALUES (?, ?, ?, ?, ?)
							ON DUPLICATE KEY UPDATE
                                order_id     = VALUES (order_id),
                                product_id      = VALUES (product_id), 
                                line_item_id          = VALUES (line_item_id),
                                unit_price   = VALUES (unit_price),
                                quantity      = VALUES (quantity)";
					$stmt = $conn->conn->prepare($sql);
					// Vincular els valors
					$stmt->bind_param( "issdd", 
											$this->order_id, 
                                            $this->product_id,  
                                            $this->line_item_id,
                                            $this->unit_price,
                                            $this->quantity
										);

					// Executar la consulta
					$stmt->execute();
				} else {
					throw new \Exception ("ID order no informat.");
				}

				$conn->conn->commit();
			} catch (\mysqli_sql_exception $e) {
				if ($conn->conn)
					$conn->conn->rollback(); 
				throw new \mysqli_sql_exception($e->getMessage());
			} finally {
				if ($conn->conn)
					// Tancar la connexió
					$conn->closeDB();         				 
			}
		} 

        // Mètode per eliminar l'order_itema la base de dades
		public function destroy() {
			error_reporting(E_ALL);
			try {
				// Connectar a la base de dades
				$db = new Database();
				$db->connectDB('C:/temp/config.db');
				//$db->conn->autocommit(false);
				//$db->conn->begin_transaction();

				// Obtenir el nom de la taula de la classe filla
				$table = static::$table; 

				if (isset($this->order_id) && isset($this->product_id)) {
					$sql = "SELECT * FROM $table WHERE order_id = $this->order_id AND product_id = $this->product_id";
					$result = $db->conn->query($sql);

					// Comprovar si hi ha resultats
					if ($result->num_rows == 1) {
						$sql = "DELETE FROM $table 
								WHERE order_id = ? 
                                AND product_id = ?";
						$stmt = $db->conn->prepare($sql);
						// Vincular els valors
						$stmt->bind_param( "ii", $this->order_id, $this->product_id );
						// Executar la consulta
						$stmt->execute();
					} else {
						throw new \Exception ("L'order_item no existeix.");
					}
				} else {
					throw new \Exception ("ID order_item no informat.");
				}
				$db->conn->commit();
			} catch (\mysqli_sql_exception $e) {
				if ($db->conn)
					$db->conn->rollback(); 
				throw new \mysqli_sql_exception($e->getMessage());
			} finally {
				if ($db->conn)
					// Tancar la connexió
					$db->closeDB();         				 
			}
		}
    }
?>