<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_crud extends CI_Model {



	public function my_query($my_query){
		$data = $this->db->query($my_query);
		if($data->num_rows()>0){
			foreach ($data->result_array() as $row);
			return $row;
		} else{
			return null;
		}
	}
	
	public function max_data($table, $field, $where=null){
		$this->db->select_max($field);
		$this->db->from($table);
		if($where != null){ $this->db->where($where); }
		$data = $this->db->get();
		foreach($data->result() as $row);
		$max = 0; if($row->$field > 0){ $max = $row->$field; }
		return $max;
	}

    public function count_data_join($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $col = explode('.', $field);
        if (count($col) > 1) {
            $alias = $col[1];
        } else {
            $alias = $field;
        }
        $this->db->select("COUNT(".$field.") AS ".$alias."");
        $this->db->from($table);
        if(is_array($table_join) && is_array($on)){
            $i = 0;
            foreach($table_join as $row){
                if (is_array($row)) {
                    $this->db->join($row['table'], $on[$i], $row['type']);
                } else {
                    $this->db->join($row, $on[$i]);
                }
                $i++;
            }
        } else {
            $this->db->join($table_join, $on);
        }
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
        foreach ($data->result_array() as $row);
        return $row[$alias];
    }
	
	public function count_data_join_over($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $col = explode('.', $field);
        if (count($col) > 1) {
            $alias = $col[1];
        } else {
            $alias = $field;
        }
        $this->db->select("COUNT(".$field.") over() AS ".$alias."");
        $this->db->from($table);
        if(is_array($table_join) && is_array($on)){
            $i = 0;
            foreach($table_join as $row){
                if (is_array($row)) {
                    $this->db->join($row['table'], $on[$i], $row['type']);
                } else {
                    $this->db->join($row, $on[$i]);
                }
                $i++;
            }
        } else {
            $this->db->join($table_join, $on);
        }
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
        foreach ($data->result_array() as $row);
        return $row[$alias];
    }

    public function count_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $col = explode('.', $field);
        if (count($col) > 1) {
            $alias = $col[1];
        } else {
            $alias = $field;
        }
        $this->db->select("COUNT(".$field.") AS ".$alias."");
        $this->db->from($table);
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
        foreach ($data->result_array() as $row);
        return $row[$alias];
    }
	
	public function count_data_over($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $col = explode('.', $field);
        if (count($col) > 1) {
            $alias = $col[1];
        } else {
            $alias = $field;
        }
        $this->db->select("COUNT(".$field.") over() AS ".$alias."");
        $this->db->from($table);
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
        foreach ($data->result_array() as $row);
        return $row[$alias];
    }
	
	public function count_join_data($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){
			$i = 0;
			foreach($table_join as $row){
                if (is_array($row)) {
                    $this->db->join($row['table'], $on[$i], $row['type']);
                } else {
                    $this->db->join($row, $on[$i]);
                }
                $i++;
			}
		} else {
			$this->db->join($table_join, $on);
		}
		if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
		$data = $this->db->get();
		return $data->num_rows();
	}
	
	public function join_data($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null, $distinct=null){
		$this->db->select($field);
        if($distinct != null){ $this->db->distinct(); }
		$this->db->from($table);
		if(is_array($table_join) && is_array($on)){ 
			$i = 0;
            foreach($table_join as $row){
			    if (is_array($row)) {
                    $this->db->join($row['table'], $on[$i], $row['type']);
                } else {
                    $this->db->join($row, $on[$i]);
                }
                $i++;
            }
		} else {
			$this->db->join($table_join, $on);
		} 
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		return $data->result_array();
	}

    public function get_join_data($table, $field, $table_join, $on, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $this->db->select($field);
        $this->db->from($table);
        if(is_array($table_join) && is_array($on)){
            $i = 0;
            foreach($table_join as $row){
                if (is_array($row)) {
                    $this->db->join($row['table'], $on[$i], $row['type']);
                } else {
                    $this->db->join($row, $on[$i]);
                }
                $i++;
            }
        } else {
            $this->db->join($table_join, $on);
        }
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();

        if($data->num_rows()>0){
            foreach ($data->result_array() as $row);
            return $row;
        } else{
            return null;
        }
    }
		
	public function search_in_data($table, $field, $where, $in, $order=null, $limit_sum=0, $limit_from=0){
		$this->db->select($field);
		$this->db->where_in($where, $in);
		$this->db->from($table);
		if($order != null){ $this->db->order_by($order); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		return $data->result_array();
	}
	
	public function get_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
        $this->db->select($field);
        $this->db->from($table);
        if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
        if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
        $data = $this->db->get();
		if($data->num_rows()>0){
			foreach ($data->result_array() as $row);
			return $row;
		} else{
			return null;
		}
	}
	
	public function create_data($tabel, $data){
		$data = $this->db->insert($tabel, $data);
		return $data;
	}
	
	public function count_read_data($table, $field, $where=null, $order=null, $group=null, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if($where != null){ $this->db->where($where); }
        if($order != null){ $this->db->order_by($order); }
        if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
		$data = $this->db->get();
		return $data->num_rows();
	}
	
	public function read_data($table, $field, $where=null, $order=null, $group=null, $limit_sum=0, $limit_from=0, $having=null){
		$this->db->select($field);
		$this->db->from($table);
		if($where != null){ $this->db->where($where); }
		if($order != null){ $this->db->order_by($order); }
		if($group != null){ $this->db->group_by($group); }
        if($having != null){ $this->db->having($having); }
		if($limit_sum != 0){ $this->db->limit($limit_sum, $limit_from); }
		$data = $this->db->get();
		return $data->result_array();
	}
	
	public function update_data($tabel, $data, $where){
		$data = $this->db->update($tabel, $data, $where);
		return $data;
	}
	
	public function delete_data($tabel, $where){
		$data = $this->db->delete($tabel, $where);
		return $data;
	}

	public function check_data($column, $table, $condition) {
	    $this->db->select($column);
        $this->db->from($table);
        $this->db->where($condition);

        return $this->db->get()->num_rows();
        /*if ($this->db->get()->row() != '') {
            return true;
        }else {
            return false;
        }*/
    }

    public function select_limit_join($table, $column, $table_join, $on, $condition=null, $order, $group=null, $limit_start, $limit_end, $having=null) {
        $join = '';
	    if(is_array($table_join) && is_array($on)){
            $i = 0;
            foreach($table_join as $row){
                if (is_array($row)) {
                    $join .= ' '.$row['type'].' JOIN '.$row['table'].' ON '.$on[$i].' ';
                } else {
                    $join .= ' JOIN '.$row.' ON '.$on[$i].' ';
                }
                $i++;
            }
        } else {
            $join .= ' JOIN '.$table_join.' ON '.$on.' ';
        }

        $order = explode(',', $order);
        $tmp = '';
        $new_order = array();
        foreach ($order as $key => $row) {
            if (substr(trim($row), 0, 7) == 'convert') {
                $tmp = $row;
            } else {
                if ($tmp != '') {
                    if ($key == 1) {
                        $order[0] = $order[0].','.$row;
                    }
                    $e1 = explode('.', $row);
                    array_push($new_order, $tmp.','.(count($e1)>1?$e1[1]:$e1[0]));
                } else {
                    $e1 = explode('.', $row);
                    array_push($new_order, (count($e1)>1?$e1[1]:$e1[0]));
                }
                $tmp = '';
            }
        }
        $data = $this->db->query(
            "WITH PAGE AS 
			(
				SELECT DISTINCT ROW_NUMBER() OVER(ORDER BY ".$order[0].") AS ROW, ".$column."
				FROM ".$table." 
				".$join."
				".($condition==null?'':'WHERE '.$condition)."
				".($group==null?'':' GROUP BY '.$group)."
				".($having==null?'':' HAVING '.$having)."
			) 
            SELECT * FROM PAGE WHERE ROW BETWEEN ".$limit_start." AND ".$limit_end.""." ORDER BY ".implode(', ', $new_order)
        );

        return $data->result_array();
    }

    public function select_limit($table, $column, $condition=null, $order, $group=null, $limit_start, $limit_end, $having=null) {
        $explode_order = explode(',', $order);
        $order = $explode_order;
        foreach ($order as $key => $item) {
            $e = explode('.', $item);
            $order[$key] = (count($e)>1?$e[1]:$e[0]);
        }
        $data = $this->db->query(
			"WITH PAGE AS 
			(
				SELECT DISTINCT ROW_NUMBER() OVER(ORDER BY ".$explode_order[0].") AS ROW, ".$column."
				FROM ".$table." 
				".($condition==null?'':'WHERE '.$condition)."
				".($group==null?'':' GROUP BY '.$group)."
				".($having==null?'':' HAVING '.$having)."
			) 
            SELECT * FROM PAGE WHERE ROW BETWEEN ".$limit_start." AND ".$limit_end.""." ORDER BY ".implode(', ', $order)
        );
        
		return $data->result_array();
    }

    public function select_limit2($table, $column, $condition=null, $order=null, $group=null, $limit_start=0, $limit_end=10, $having=null) {
        $data = $this->db->query(
            "SELECT ".$column."
				FROM ".$table." 
				".($condition==null?'':'WHERE '.$condition)."
				".($group==null?'':' GROUP BY '.$group)."
				".($order==null?'':' ORDER BY '.$order)."
				".($having==null?'':' HAVING '.$having)."
				OFFSET ".$limit_start." ROWS FETCH NEXT ".$limit_end." ROWS ONLY"
        );

        return $data->result_array();
    }

    public function select_limit2_join($table, $column, $table_join, $on, $condition=null, $order=null, $group=null, $limit_start=0, $limit_end=10, $having=null) {
        $join = '';
        if(is_array($table_join) && is_array($on)){
            $i = 0;
            foreach($table_join as $row){
                if (is_array($row)) {
                    $join .= ' '.$row['type'].' JOIN '.$row['table'].' ON '.$on[$i].' ';
                } else {
                    $join .= ' JOIN '.$row.' ON '.$on[$i].' ';
                }
                $i++;
            }
        } else {
            $join .= ' JOIN '.$table_join.' ON '.$on.' ';
        }

        $data = $this->db->query(
            "SELECT ".$column."
				FROM ".$table." 
				".$join."
				".($condition==null?'':'WHERE '.$condition)."
				".($group==null?'':' GROUP BY '.$group)."
				".($having==null?'':' HAVING '.$having)."
				".($order==null?'':' ORDER BY '.$order)."
				OFFSET ".$limit_start." ROWS FETCH NEXT ".$limit_end." ROWS ONLY"
        );

        return $data->result_array();
    }

    public function select_union($col1,$tb1,$con1=null,$col2,$tb2,$con2=null,$order=null,$limit_from=null,$limit_to=null) {
        $this->db->select($col1);
        $this->db->from($tb1);
        if($con1 != null){ $this->db->where($con1); }
        $q1 = $this->db->get_compiled_select();

        $this->db->select($col2);
        $this->db->from($tb2);
        if($con2 != null){ $this->db->where($con2); }
        $q2 = $this->db->get_compiled_select();

        $q_order = ($order != null)?' ORDER BY '.$order:'';
        return $this->db->query(''.$q1.' UNION '.$q2.$q_order)->result_array();
    }
	
}

