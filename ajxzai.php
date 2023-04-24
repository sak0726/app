<?php
    $id=$_GET['cat'];
    $this->db->where('z_cat',$id);
    $z=$this->db->get('mat');
?>
    <select id="p_zai" class="form-control" style="width:150px;">
        <?php foreach($z->result() as $z){
            echo'<option value="'.$z->z_mat.'">'.$z->z_mat.'</option>';
        }
        ?>
    </select>
