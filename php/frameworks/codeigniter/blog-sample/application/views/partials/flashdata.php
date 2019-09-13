<?php if ($this->session->has_userdata('success')) : ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('success') ?>
    </div>
<?php endif; ?>