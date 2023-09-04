<?php
include '../inc/ad.common.php';

$valueSale = GetCount("orders", "SUM(totalAmount)");
$numOrders = GetCount("orders");
$numCustomers = GetCount("customer");
$numProducts = GetCount("product");
$prod_namearr = GetXArrFromYID("SELECT id, productName from product", 3);

$sale_arr = GetXArrFromYID("SELECT SUM(totalAmount) from orders GROUP BY orderDate");
$sale_json = json_encode($sale_arr);

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Start Header Top Area -->
    <?php include "_header.php"; ?>
    <?php include "_menu.php"; ?>
    <!-- Start Status area -->
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $numOrders; ?></span></h2>
                            <p>Total Orders</p>
                        </div>
                        <div class="sparkline-bar-stats1"><?php echo randomSparkline(); ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $valueSale; ?></span></h2>
                            <p>Sale Value</p>
                        </div>
                        <div class="sparkline-bar-stats2"><?php echo randomSparkline(); ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $numCustomers; ?></span></h2>
                            <p>Live Customers</p>
                        </div>
                        <div class="sparkline-bar-stats3"><?php echo randomSparkline(); ?></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $numProducts; ?></span></h2>
                            <p>Active Products</p>
                        </div>
                        <div class="sparkline-bar-stats4"><?php echo randomSparkline(); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status area-->
    <!-- Start Sale Statistic area-->
    <div class="sale-statistic-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <div class="curved-inner-pro">
                            <div class="curved-ctn">
                                <h2>Daily Sale Trends</h2>
                            </div>
                        </div>
                        <div id="sale-line-chart" class="flot-chart-sts flot-chart"></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="recent-items-wp notika-shadow mg-tb-30">
                        <div class="rc-it-ltd">
                            <div class="recent-items-ctn">
                                <div class="recent-items-title">
                                    <h2>Recent Items Sold</h2>
                                </div>
                            </div>
                            <div class="recent-items-inn">
                                <table class="table table-inner table-vmiddle">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th style="width: 60px">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ord_items = getDataFromTable("order_item", "fkProductId, unitPrice", "order by id desc limit 6");
                                        if (!empty($ord_items)) {
                                            foreach ($ord_items as $ord_obj) {
                                                $prod_name = isset($prod_namearr[$ord_obj->fkProductId]) ? $prod_namearr[$ord_obj->fkProductId] : "-";
                                        ?>
                                                <tr>
                                                    <td class="f-500 c-cyan"><?php echo $ord_obj->fkProductId; ?></td>
                                                    <td><?php echo $prod_name; ?></td>
                                                    <td class="f-500 c-cyan"><?php echo $ord_obj->unitPrice; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No records found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="recent-items-chart" class="flot-chart-items flot-chart vt-ct-it tb-rc-it-res"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sale Statistic area-->

    <!-- Start Footer area-->
    <?php include "_footer.php"; ?>
    <script type="text/javascript">
        var saleData = <?php echo $sale_json; ?>;
        var options = {};
        $("#sale-line-chart")[0] && $.plot($("#sale-line-chart"), [{
            data: saleData,
            lines: {
                show: !0,
                fill: .98
            },
            label: "Sale Value(INR)",
            stack: !0,
            color: "#e3e3e3"
        }], options), $(".flot-chart")[0] && ($(".flot-chart").bind("plothover", function(event, pos, item) {
            if (item) {
                var x = item.datapoint[0].toFixed(2),
                    y = item.datapoint[1].toFixed(2);
                $(".flot-tooltip").html(item.series.label + " of " + x + " = " + y).css({
                    top: item.pageY + 5,
                    left: item.pageX + 5
                }).show()
            } else $(".flot-tooltip").hide()
        }), $("<div class='flot-tooltip' class='chart-tooltip'></div>").appendTo("body"));
    </script>
</body>

</html>