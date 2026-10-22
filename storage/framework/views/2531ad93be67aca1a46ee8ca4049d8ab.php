


<?php $__env->startSection('titulo', 'Produtos Mais Vendidos'); ?>

<?php $__env->startSection('conteudo'); ?>
    <div class="container mt-4">
        <h2 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Produtos Mais Vendidos
        </h2>

        <div class="card p-4 mt-3">
            <?php echo $chart->container(); ?>

        </div>
    </div>

    <script src="<?php echo e($chart->cdn()); ?>"></script>
    <?php echo e($chart->script()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ellen\Desktop\PriplupCroche\resources\views/venda/produtosMaisVendidosCHart.blade.php ENDPATH**/ ?>