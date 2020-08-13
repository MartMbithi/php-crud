<?php
    //Borrow Book Operations
    $query ="SELECT COUNT(*) FROM `library_operations` WHERE operation_type ='Borrow'  ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($borrow);
    $stmt->fetch();
    $stmt->close();

    //Return Book Operations
    $query ="SELECT COUNT(*) FROM `library_operations` WHERE operation_type ='Return'  ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($return);
    $stmt->fetch();
    $stmt->close();

    //Lost Books
    $query ="SELECT COUNT(*) FROM `library_operations` WHERE operation_type ='Lost'  ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($lost);
    $stmt->fetch();
    $stmt->close();

    //Damanged Book
    $query ="SELECT COUNT(*) FROM `library_operations` WHERE operation_type ='Damanged'  ";
    $stmt = $mysqli->prepare($query);
    $stmt ->execute();
    $stmt->bind_result($damanged);
    $stmt->fetch();
    $stmt->close();

?>
<script>
    /*
        ===================================
            Unique Visitors | Options
        ===================================
    */

    var d_1options1 = {
      chart: {
          height: 350,
          type: 'bar',
          toolbar: {
            show: false,
          },
          dropShadow: {
              enabled: true,
              top: 1,
              left: 1,
              blur: 2,
              color: '#acb0c3',
              opacity: 0.7,
          }
      },
      colors: ['#5c1ac3', '#ffbb44'],
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: '55%',
              endingShape: 'rounded'  
          },
      },
      dataLabels: {
          enabled: false
      },
      legend: {
            position: 'bottom',
            horizontalAlign: 'center',
            fontSize: '14px',
            markers: {
              width: 10,
              height: 10,
            },
            itemMargin: {
              horizontal: 0,
              vertical: 8
            }
      },
      stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
      },
      series:[{
          name: 'Books',
          data: [<?php echo $borrow;?> , <?php echo $return;?>, <?php echo $damanged;?>, <?php echo $lost;?>]
      }],
      xaxis: {
          categories: ['Borrowed Books', 'Returned Books', 'Damanged Books', 'Lost Books'],
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: 'vertical',
          shadeIntensity: 0.3,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 0.8,
          stops: [0, 100]
        }
      },
      tooltip: {
          y: {
              formatter: function (val) {
                  return val
              }
          }
      }
    }
    //Render Chart
    var d_1C_3 = new ApexCharts(
        document.querySelector("#uniqueVisits"),
        d_1options1
    );
    d_1C_3.render();
</script>