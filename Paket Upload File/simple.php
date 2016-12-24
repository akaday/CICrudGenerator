FORM
enctype="multipart/form-data"
<div class="form-group">
    <label for="varchar">foto <?php echo form_error('foto') ?></label>
    <br>
    <?php if(!empty($foto)): ?>
    <img id="image_baru1" src='<?php echo base_url()."images/produk/".$foto; ?>'
                    style="max-height= 200px; max-width: 200px;"
                    class="img-rounded" />
    <?php else : ?>
    <img id="image_baru1" src='<?php echo base_url()."images/default.png"; ?>'
                    style="max-height= 200px; max-width: 200px;"
                    class="img-rounded" />
    <?php endif; ?>
    <br>
    <input type='file' name='foto' onchange="readURL1(this);" >
</div>
<br>



LIST dan Read
<?php if(!empty($ganti_modul->foto)): ?>
<img id="image_baru1" src='<?php echo base_url()."images/gallery/".$ganti_modul->foto; ?>'
                style="max-height= 200px; max-width: 200px;"
                class="img-rounded" />
<?php else : ?>
<img id="image_baru1" src='<?php echo base_url()."images/default.png"; ?>'
                style="max-height= 200px; max-width: 200px;"
                class="img-rounded" />
<?php endif; ?>


Controller
<?php
//Disable $data[Foto]
//Disable foto di rules
//MAsukkin Function Delete Foto Lama
function _cek_old_file($foto_lama)
    {   
        $DelFilePath = './images/gallery/'.$foto_lama;
            
        if (file_exists($DelFilePath)) 
        {   
            unlink ($DelFilePath);
        }
    }

       // 'foto' => $this->input->post('foto',TRUE),

        if($_FILES["foto"]["error"] != 0)
        {   //Foto Bermasalah
            $this->session->set_flashdata('message', 'Update Record Success');
        }
        else
        {   //Validasi File
            $config['upload_path'] = './images/gallery/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $config['encrypt_name'] = TRUE;

            //load upload class library
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto'))
            {   // case - failure
                $this->session->set_flashdata('message', 'Update Record Success, But photo error to upload');
            }
            else
            {   // case - success
                $foto_lama = $this->ganti_modul_model->get_by_id($this->input->post('id_db', TRUE))->foto;
                if(!empty($foto_lama))
                {   //echo $foto_lama;
                    $this->_cek_old_file($foto_lama);                    
                }
                $upload_data = $this->upload->data();
                $nama_file = $upload_data['file_name'];
                $data['foto'] = $nama_file;
                $this->session->set_flashdata('message', 'Update Record Success');
            }
        }

?>