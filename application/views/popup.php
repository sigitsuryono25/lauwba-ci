
<div class="modal fade" id="popupimage"  tabindex="-1" role="dialog" aria-labelledby="popupimage" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
    <div class="modal-content" style="background: transparent; border: 0px">
        <div class="modal-body">
          <?php $data = $this->db->query("SELECT * FROM `popup_image` LIMIT 1")?>
          <?php if(!empty($data->row())){?>
          <a href="<?php echo $data->row()->url ?>" target="_blank"><img src="<?php echo base_url('sliderimages/'). $data->row()->foto?>" class="img-fluid"/></a>
          <?php }?>
        </div>
        <div class="text-center" style="margin-top: -10px">
            <small style="cursor: link" class="text-white" id="close-popup" data-dismiss="modal"><i class="fa fa-times-circle"></i>TUTUP</small>
        </div>  
    </div>
  </div>
</div>

<script>
    function showPopup(){
        // $.get("<?php echo site_url('welcome/getPopupSettings')?>", null, function(data){
        //     if(data ! === null){
        //         var isActive = data.is_active;
        //         if(isActive === 'Y'){
        //             if(getCookie('lauwba_popup') == null){
        // //                 $('#popupimage').modal({
        // // 			backdrop: 'static'
        // //         		});
        //         		 $('#popupimage').modal('show');
        //             }
        //         }
        //     }
        // }, 'JSON');
    }
</script>