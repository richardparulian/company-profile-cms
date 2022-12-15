<?php

class M_Global extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	function query($query)
	{
		return $this->db->query($query);
	}

	function view($table)
	{
		return $this->db->query("SELECT * FROM $table where status=1");
	}

	function get_list($table, $data)
	{
		$query =  $this->db->get_where($table, $data);
		return $query;
	}

	function get_result($table)
	{
		return $this->db->query("SELECT * FROM $table");
	}

	function insert($data, $table)
	{
		$insert = $this->db->insert($table, $data);


		if (!$insert) {
			$error = $this->db->error();
		} else {
			$error = "success";
		}
		return $error;
	}

	function insert_id($data, $table)
	{
		$insert = $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	function update_data($where, $data, $table)
	{
		$update = $this->db->where($where);
		$update = $this->db->update($table, $data);
		if (!$update) {
			$error = $this->db->error();
		} else {
			$error = "success";
		}
		return $error;
	}

	function update($table, $param)
	{
		$this->db->query("UPDATE $table set $param");
	}

	function delete_data($where, $data, $table)
	{
		$delete = $this->db->where($where);
		$delete = $this->db->delete($table, $data);
		if (!$delete) {
			$error = $this->db->error();
		} else {
			$error = "success";
		}
		return $error;
	}

	function delete($table, $param)
	{
		$insert = $this->db->query("DELETE FROM $table where $param");
		if (!$insert) {
			$error = $this->db->error();
		} else {
			$error = "success";
		}
		return $error;
	}

	function getmultiparam($table, $param)
	{
		return $this->db->query("SELECT * FROM $table where $param");
	}

	function getmulti2param($table, $param1, $param2)
	{
		return $this->db->query("SELECT * FROM $table where $param1 and $param2");
	}

	function selectid($col, $table, $param)
	{
		return $this->db->query("SELECT $col FROM $table where $param order by $col desc limit 1");
	}

	function globalquery($param)
	{
		return $this->db->query("$param");
	}

	function getmultiparamrows($table, $param)
	{
		return $this->db->query("SELECT * FROM $table where $param")->num_rows();
	}

	function getmultiparam2($table, $param)
	{
		return $this->db->query("SELECT * FROM $table where $param")->result_array();
	}

	function getmultiparam3($table, $param)
	{
		return $this->db->query("SELECT $table where $param");
	}

	function getlast($table, $id, $param)
	{
		return $this->db->query("SELECT * FROM $table where $id = '$param' order by NO desc limit 1");
	}

	function q2join($table1, $table2, $kolom1, $kolom2, $param)
	{
		return $this->db->query("SELECT 
			a.*,b.* from $table1 a left join
			$table2 b on $kolom1 = $kolom2 where $param 
			");
	}

	function qrealisasi($table1, $table2, $kolom1, $kolom2, $param)
	{
		return $this->db->query("SELECT 
			a.*,b.REALISASI from $table1 a left join
			$table2 b on $kolom1 = $kolom2 where $param 
			");
	}

	function query2join($table1, $table2, $kolom1, $kolom2, $param, $value)
	{
		return $this->db->query("SELECT 
			a.*,b.* from $table1 a left join
			$table2 b on $kolom1 = $kolom2 where $param = $value
			");
	}

	function query2joinmulti($table1, $table2, $kolom1, $kolom2, $param)
	{
		return $this->db->query("SELECT 
			a.*,b.* from $table1 a left join
			$table2 b on $kolom1 = $kolom2 where $param
			");
	}

	function query2joinmulti2($selectcol, $table1, $table2, $kolom1, $kolom2, $param)
	{
		return $this->db->query("SELECT 
			$selectcol from $table1 a left join
			$table2 b on $kolom1 = $kolom2 where $param
			");
	}

	function getnumrowsupload($table, $kolom, $param, $param2, $param3)
	{
		$q = $this->db->query("SELECT * FROM $table where $kolom = '$param' and TAHUNBELANJA = '$param2' and KODEDANABELANJA='$param3'");
		return $q->num_rows();
	}

	function getnumrowsupload2($table, $kolom, $param, $param2, $param3, $param4)
	{
		$q = $this->db->query("SELECT * FROM $table where $kolom = '$param' and TAHUNBELANJA = '$param2' and KODEDANABELANJA='$param3' $param4");
		return $q->num_rows();
	}

	function getnumrowsupload3($table, $param)
	{
		$q = $this->db->query("SELECT * FROM $table where $param");
		return $q->num_rows();
	}

	function getnumrows($table, $kolom, $param)
	{
		$q = $this->db->query("SELECT * FROM $table where $kolom = '$param'");
		return $q->num_rows();
	}

	function getsum($table, $kolom, $param)
	{
		return $this->db->query("SELECT SUM($kolom) as JUMLAH from $table where $param");
	}

	function distinct($col, $table, $param)
	{
		return $this->db->query("select distinct($col) as $col from $table where $param");
	}

	function countdistinct($col, $table, $param)
	{
		return $this->db->query("select count(distinct($col)) as $col from $table where $param");
	}

	function join_only($table1, $table2, $kolom1, $kolom2)
	{
		return $this->db->query("SELECT 
			* from $table1 left join
			$table2 on $kolom1 = $kolom2 
			");
	}

	function join_only_manytabs($table1, $table2, $table3, $kolom1, $kolom2, $kolom3)
	{
		return $this->db->query("SELECT * from $table1 left join $table2 on $kolom1 = $kolom2
			left join $table3 on $kolom1 = $kolom3
			");
	}

	function getlike($table, $param)
	{
		return $this->db->query("SELECT * FROM $table WHERE $param");
	}

	function count($table, $param)
	{
		return $this->db->get_where($table, $param)->num_rows();
	}

	function invoice_number()
	{
		$dateNow = date("Y-m-d");

		$this->db->select('RIGHT(Invoice.InvoiceNumber,4) as invoice_number', FALSE);
		$this->db->order_by('invoice_number', 'DESC');
		$this->db->limit(1);
		$this->db->where('DATE(InvoiceDate)', $dateNow);

		$query = $this->db->get('Invoice');

		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$code = intval($data->invoice_number) + 1;
		} else {
			$code = 1;
		}
		$tgl            = date('Ymd');
		$batas          = str_pad($code, 4, "0", STR_PAD_LEFT);
		$showCode     	= $tgl . $batas;

		return $showCode;
	}

	function loadToJson()
	{
		$product 		= $this->db->get('Product')->result_array();
		$response  		= [];

		foreach ($product as $key) {
			$id    	= $key['ProductID'];
			$array	= (array)$id;

			foreach ($array as $arr) {
				$image    = $this->db->get_where('ProductPic', ['ProductID' => $arr])->row_array();
			}
			$response[] = array(
				'id'    => $key['ProductID'],
				'image' => isset($image['PicName']) ? $image['PicName'] : 'Default-Product-Pic.png',
				'name'  => $key['ProductName'],
				'price' => $key['ProductPrice'],
				'qty'   => 1
			);
		}
		return json_encode($response, JSON_PRETTY_PRINT);
	}
}
