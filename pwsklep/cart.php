<?php

class cart{
	public function __construct()
	{
		
	}
	
	public function add($id)
	{
		global $pdo, $session;
		
		$stmt = $pdo->prepare("SELECT * FROM sessioncart WHERE product_id = :id AND session_id = :sid");
		$stmt->bindValue(':id',$id, PDO::PARAM_INT);
		$stmt->bindValue(':sid',$session->getSessionId(), PDO::PARAM_STR);
		$stmt->execute();
		
		if($row = $stmt->fetchAll(PDO::FETCH_ASSOC))
		{
			//update
			//var_dump($row);

			$qty=$row[0]['quantity']+1;			
			$stmt=$pdo->prepare("UPDATE sessioncart SET quantity = :qty WHERE session_id = :sid AND product_id = :pid");
			$stmt->bindValue(':qty',$qty, PDO::PARAM_INT);
			$stmt->bindValue(':sid',$session->getSessionId(), PDO::PARAM_STR);
			$stmt->bindValue(':pid',$id,PDO::PARAM_INT);
			$stmt->execute();
			
			
		}
		else
		{
			//insert
			$stmt = $pdo->prepare("INSERT INTO sessioncart (id, session_id, product_id, quantity) VALUES (null, :sid, :pid, 1)");
			$stmt->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
			$stmt->bindValue(':pid', $id, PDO::PARAM_INT);
			$stmt->execute();
		}
		
	}
	
	public function remove ($id)
	{
		global $pdo, $session;
		
		$stmt=$pdo->prepare("SELECT * FROM sessioncart WHERE product_id = :id AND session_id = :sid");
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->bindValue(':sid',$session->getSessionId(), PDO::PARAM_STR);
		$stmt->execute();
		
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$qty = $row[0]['quantity'];
		$qty--;
		
		if($qty==0)
		{
			$stmt=$pdo->prepare("DELETE FROM sessioncart WHERE product_id = :id AND session_id = :sid");
			$stmt->bindValue(":id",$id,PDO::PARAM_INT);
			$stmt->bindValue(':sid',$session->getSessionId(), PDO::PARAM_STR);
			$stmt->execute();
		}
		else
		{
			
			$stmt=$pdo->prepare("UPDATE sessioncart SET quantity = :qty WHERE product_id = :id AND session_id = :sid");
			$stmt->bindValue(':qty',$qty, PDO::PARAM_INT);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':sid',$session->getSessionId(), PDO::PARAM_STR);
			$stmt->execute();
		}
			

	}
	
	public function getProducts()
	{
		global $pdo, $session;
		
		$stmt = $pdo->prepare("SELECT * FROM sessioncart s LEFT OUTER JOIN products p ON (s.product_id = p.product_id) WHERE s.session_id = :sid");
		$stmt->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	public function clear()
	{
		global $pdo, $session;
		
		$stmt = $pdo->prepare("DELETE FROM sessioncart WHERE session_id = :sid");
		$stmt->bindValue(':sid', $session->getSessionId(), PDO::PARAM_STR);
		$stmt->execute();
	}
	
}


?>