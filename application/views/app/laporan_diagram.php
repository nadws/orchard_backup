<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">  
  <link rel="stylesheet" href="<?= base_url() ?>asset/time/jquery.skedTape.css">
</head>
<body>
    <h1><?= $title; ?></h1>
<center>
              <div class="card">
                <div class="card-header">
                  <div class="card-body">
                    <hr>
                    <div id="sked2"></div>
                  </div>
                </div>
              </div>
</center>

<?php
// $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl)));
$awal  = date_create($tgl);
$akhir = date_create();
$diff  = date_diff( $awal, $akhir );
$hari = $diff->d;
$jam = $diff->h;
$convert_jam = $hari*24;
?>

<input type='hidden' id='jam' value='<?= $convert_jam ?>'>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="<?= base_url() ?>asset/time/jquery.skedTape.js"></script>


<script>
  $(document).ready(function () {
    $(".sked-tape__event").each(function(index) {
      var colorR = Math.floor((Math.random() * 256));
      var colorG = Math.floor((Math.random() * 256));
      var colorB = Math.floor((Math.random() * 256));
      $(this).css("background-color", "rgb(" + colorR + "," + colorG + "," + colorB + ")");
    });
  })
</script>
<?php  
$d_o = array();
foreach ($d_order as $key => $value) 
{
  $nama_t =  $value['nama_t'];
  $total = $value['total'];
  $d = array(
    'id'  => $value['id_terapis'],
    'name'  => "$nama_t ($total)",
    'tzOffset'  => $value['tzoffset'],
  );
  $d_o[] = $d;
}
$data = array();
foreach ($d_order_d as $key => $value) 
{
  $d = array(
    'name'  => $value['nama'].' - '.$value['nm_servis'],
    'location'  => $value['location'],
    'start'  => $value['start_t'],
    'end'  => $value['end_t'],
  );
  $data[] = $d;
}
// $start2 = date('H:i:s', strtotime($start));
//     $end2 = date('H:i:s', strtotime($end));
    
//     $start_t = date('D M d Y ').$start2.' GMT+0800 (Central Indonesia Time)';
//     $end_t = date('D M d Y ').$end2.' GMT+0800 (Central Indonesia Time)';
// $tglc = 

?>

<script type="text/javascript">
// console.log(new Date());
            // --------------------------- Data --------------------------------

            var locations = <?php echo json_encode($d_o); ?>;
            var events = <?php echo json_encode($data); ?>;
            // -------------------------- Helpers ------------------------------
            function today(hours, minutes) {
              var date = new Date();
              date.setHours(hours, minutes, 0, 0);
              return date;
            }

            function custom(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() - a * 60 * 60 * 1000);
              return date;
            }

            function besok(hours, minutes) {
              var hour = document.getElementById("jam").value;
              var a = parseInt(hour);
              var date = today(hours, minutes);
              date.setTime(date.getTime() + a * 60 * 60 * 1000);
              return date;
            }

            function yesterday(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() - 24 * 60 * 60 * 1000);
              return date;
            }
            function tomorrow(hours, minutes) {
              var date = today(hours, minutes);
              date.setTime(date.getTime() + 24 * 60 * 60 * 1000);
              return date;
            }
            // --------------------------- Example 2 ---------------------------
            var sked2Config = {
              caption: 'Terapis',
              start: custom(10, 0),
              end: custom(18, 0),
              showEventTime: true,
              showEventDuration: true,
              locations: locations.map(function(location) {
                var newLocation = $.extend({}, location);
                delete newLocation.tzOffset;
                return newLocation;
              }),
              events: events.slice(),
              tzOffset: 0,
              sorting: true,
              orderBy: 'name',
            };
            var $sked2 = $.skedTape(sked2Config);
            $sked2.appendTo('#sked2').skedTape('render');
			//$sked2.skedTape('destroy');
      $sked2.skedTape(sked2Config);
            // --------------------------- Example 3 ---------------------------
            $('#modal1').on('shown.bs.modal', function() {
              $('#sked3').skedTape(sked2Config);
            });
            $('#modal1').on('hidden.bs.modal', function() {
                // This is not necessary, but it always a good idea to do not
                // take processing time for elements that don't show.
                $('#sked3').skedTape('destroy');
              });

            var $skedTabBtn = $('a[data-toggle="tab"][href="#sked-tab"]');
            $skedTabBtn.on('shown.bs.tab', function(e) {
              $('#sked4').skedTape(sked2Config);
            });
            $skedTabBtn.on('hidden.bs.tab', function(e) {
              $('#sked4').skedTape('destroy');
            });
          </script>

</body>
</html>