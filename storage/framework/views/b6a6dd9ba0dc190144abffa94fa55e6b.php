<?php $__env->startSection('titulo', 'Listagem de Itens de Pedido'); ?>

<?php $__env->startSection('conteudo'); ?>

<div style="background-color: #fffaf6; min-height: 100vh; padding-bottom: 40px;">

    <div class="row"
         style="background-color: #fffaf6; padding: 30px 40px;">

        <h3 style="color: #6d3f36;
                   font-family: Georgia, serif;
                   font-weight: bold;
                   text-align: center;
                   margin-bottom: 25px;">
            Listagem de Itens de Pedido
        </h3>

        <form action="<?php echo e(route('item_pedido.search')); ?>" method="post">
            <?php echo csrf_field(); ?>

            <div class="row">

                <div class="col-2">
                    <label for="tipo"
                           style="color: #555;
                                  font-size: 13px;
                                  margin-bottom: 5px;">
                        Tipo
                    </label>

                    <select name="tipo"
                            id="tipo"
                            class="form-select"
                            style="border: 1px solid #aaa;
                                   border-radius: 20px;
                                   font-size: 13px;
                                   height: 40px;">

                        <option value="pedido_id">Pedido</option>
                        <option value="produto_id">Produto</option>
                        <option value="quantidade">Quantidade</option>

                    </select>
                </div>

                <div class="col-5">
                    <label for="valor"
                           style="color: #555;
                                  font-size: 13px;
                                  margin-bottom: 5px;">
                        Valor
                    </label>

                    <input type="text"
                           name="valor"
                           id="valor"
                           placeholder="Pesquisar..."
                           class="form-control"
                           style="border: 1px solid #aaa;
                                  border-radius: 20px;
                                  font-size: 13px;
                                  height: 40px;
                                  padding-left: 15px;">
                </div>

                <div class="col-5"
                     style="padding-top: 25px;">

                    <button type="submit"
                            class="btn"
                            style="background-color: #ed8eaa;
                                   border: none;
                                   border-radius: 20px;
                                   color: white;
                                   font-size: 13px;
                                   padding: 9px 25px;">
                        Buscar
                    </button>

                    <a href="<?php echo e(url('item_pedido/create')); ?>"
                       class="btn"
                       style="background-color: #e8bcc5;
                              border: none;
                              border-radius: 20px;
                              color: white;
                              font-size: 13px;
                              padding: 9px 25px;">
                        Novo
                    </a>

                </div>

            </div>
        </form>

    </div>

    <div class="row mt-4"
         style="padding: 0 40px;">

        <table class="table table-hover"
               style="width: 100%;
                      font-size: 14px;
                      color: #555;
                      border: 1px solid #e2d9d5;
                      background-color: white;">

            <thead>
                <tr style="background-color: #fffaf6;">

                    <th scope="col" style="padding: 16px;">
                        #
                    </th>

                    <th scope="col" style="padding: 16px;">
                        Pedido
                    </th>

                    <th scope="col" style="padding: 16px;">
                        Produto
                    </th>

                    <th scope="col" style="padding: 16px;">
                        Quantidade
                    </th>

                    <th scope="col"
                        style="padding: 16px; text-align: center;">
                        Ação
                    </th>

                    <th scope="col"
                        style="padding: 16px; text-align: center;">
                        Ação
                    </th>

                </tr>
            </thead>

            <tbody>

                <?php $__empty_1 = true; $__currentLoopData = $dados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <tr style="background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">

                        <th scope="row"
                            style="padding: 16px;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">
                            <?php echo e($item->id); ?>

                        </th>

                        <td style="padding: 16px;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">
                            Pedido #<?php echo e($item->pedido_id); ?>

                        </td>

                        <td style="padding: 16px;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">
                            <?php echo e($item->produto->nome ?? 'Produto não encontrado'); ?>

                        </td>

                        <td style="padding: 16px;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">
                            <?php echo e($item->quantidade); ?>

                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">

                            <a class="btn"
                               title="Editar"
                               href="<?php echo e(route('item_pedido.edit', $item->id)); ?>"
                               style="background-color: #ed8eaa;
                                      border: none;
                                      border-radius: 20px;
                                      color: white;
                                      font-size: 13px;
                                      padding: 7px 18px;">
                                Editar
                            </a>

                        </td>

                        <td style="padding: 10px;
                                   text-align: center;
                                   background-color: <?php echo e($loop->odd ? '#f4dada' : '#fff4f1'); ?>;">

                            <form action="<?php echo e(route('item_pedido.destroy', $item->id)); ?>"
                                  method="post">

                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit"
                                        class="btn"
                                        title="Excluir"
                                        style="background-color: #d90045;
                                               border: none;
                                               border-radius: 20px;
                                               color: white;
                                               font-size: 13px;
                                               padding: 7px 18px;"
                                        onclick="return confirm('Deseja excluir este item?')">
                                    Deletar
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <tr>
                        <td colspan="6"
                            style="padding: 20px; text-align: center;">
                            Nenhum item de pedido cadastrado.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PipLupCroche\resources\views/item_pedido/list.blade.php ENDPATH**/ ?>