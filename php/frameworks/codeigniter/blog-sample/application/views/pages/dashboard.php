<div class="container">

    <?php if (isset($post->id)) : ?>
        <h4> Editing - <?php echo $post->title ?> </h4>
    <?php else : ?>
        <h4> Create New post </h4>
    <?php endif; ?>

    <?php $this->load->view('partials/flashdata') ?>
    
    <a href="<?php echo site_url('dashboard') ?>" class="btn btn-success btn-sm"> All Posts </a>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Title : </label>
                    <input type="text" name="title" id="" value="<?php echo set_value('title', @$post->title) ?>" class="form-control">
                    <span class="text text-danger"><?php echo form_error('title') ?></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Content : </label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo set_value('content', @$post->content) ?></textarea>
                    <span class="text text-danger"><?php echo form_error('content') ?></span>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </div>
    </form>

</div>