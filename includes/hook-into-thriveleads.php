<?php

// when ThriveLeads form is submitted we'll run our function
add_action("tve_leads_form_conversion", "padma_tvi_forward_post_to_padma", 10, 5); 

function padma_tvi_forward_post_to_padma($main, $form_type, $variation, $active_test_id, $data, $post_data) {
  error_log(padma_tvi_post_form($post_data));
}

?>