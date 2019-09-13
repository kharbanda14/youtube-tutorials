<div class="container">

    <?php $this->load->view('partials/flashdata') ?>

    <h4> Posts List <a href="<?php echo site_url('dashboard/create') ?>" class="btn btn-success btn-sm float-right"> Create Post </a> </h4>

    <table class="table table-striped">

        <tr>
            <th> ID </th>
            <th> Title </th>
            <th> Actions </th>
        </tr>


        <?php foreach ($posts as $post) : ?>

            <tr>
                <td> <?php echo $post->id ?> </td>
                <td> <?php echo $post->title ?> </td>
                <td>
                    <a class="btn btn-info" href="<?php echo site_url(['dashboard/edit', $post->id]) ?>"> Edit </a>
                    <a class="btn btn-success" href="<?php echo site_url(['post', $post->slug]) ?>"> View </a>
                    <a class="btn btn-danger" href="<?php echo site_url(['dashboard/delete', $post->id]) ?>"> Delete </a>
                </td>
            </tr>

        <?php endforeach; ?>



    </table>

</div>