<?php 
?>
<div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" value="1"></td>
                                    <td>Dưới 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="2"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="3"></td>
                                    <td>10.000.000đ - 15.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="4"></td>
                                    <td>15.000.000đ - 20.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value="5"></td>
                                    <td>Trên 20.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                     <?php    if(isset($listCat))
                                {
                                    ?>
                        <table>

                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                              
                                 foreach($listCat as $cat){?>
                                <tr>
                                    <td><input type="radio" name="r-brand" value="<?php echo $cat['cat_id']?>"></td>
                                    <td><?php echo $cat['cat_title']?></td>
                                </tr>
                                <?php }?>
                              
                            </tbody>
                        </table>
                       
                        <?php }?>
                        <input type="hidden" name="cat_product" value="<?php echo $catParent['cat_id']?>">
                    </form>
                </div>
            </div>