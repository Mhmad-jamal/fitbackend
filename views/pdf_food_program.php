<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            font-family: 'Cairo', sans-serif;

        }

        #element {
            width: 80%;
            margin: 0 auto;
            margin-top:10px;
        }

        .title {
            background-color: #f8cc00;
            padding: 12px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title2 {
            padding: 10px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .title h1 {
            font-size: 25px;
            font-weight: bold;
            color: black;
            margin: 0;
        }

        .days-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 12px;
        }

        .day {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 10px;
            padding: 12px;
            text-align: center;
        }

        .day h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #333;
        }

        .day ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .day li {
            margin-bottom: 5px;
            color: #666;
        }

        .table th,
        .table td {
            text-align: right;
            font-size:10px
        }
    </style>
</head>

<body>
    <div id="element">
        <div class="title">
            <h1>برنامح الغذائي الأسبوعي</h1>
        </div>
        <div class="title2">
    <a href="<?= $program_data['link']; ?>">
        <h4><?= $program_data['name']; ?></h4>
    </a>
</div>

        <div class="days-container">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم الأول</th>
                    </tr>
                    <tr>
                        <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
usort($diets_data_day1, function($a, $b) {
    return $a[0]['course'] - $b[0]['course'];
});
    foreach ($diets_data_day1 as $key => $day1_data) {
        echo "<th>{$day1_data[0]['diet_title']}</th>";
    }
?>
                       
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم الثاني</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                  usort($diets_data_day2, function($a, $b) {
                    return $a[0]['course'] - $b[0]['course'];
                });
                  foreach ($diets_data_day2 as $key => $day2_data) {
                      echo "<th>{$day2_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black; ">اليوم  الثالث</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                    usort($diets_data_day3, function($a, $b) {
                        return $a[0]['course'] - $b[0]['course'];
                    });
                  
                  foreach ($diets_data_day3 as $key => $day3_data) {
                      echo "<th>{$day3_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم  الرابع</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                     usort($diets_data_day4, function($a, $b) {
                        return $a[0]['course'] - $b[0]['course'];
                    });
                  
                  foreach ($diets_data_day4 as $key => $day4_data) {
                      echo "<th>{$day4_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم  الخامس</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                  usort($diets_data_day5, function($a, $b) {
                    return $a[0]['course'] - $b[0]['course'];
                });
                  foreach ($diets_data_day5 as $key => $day5_data) {
                      echo "<th>{$day5_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم  السادس</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                  usort($diets_data_day6, function($a, $b) {
                    return $a[0]['course'] - $b[0]['course'];
                });
                  foreach ($diets_data_day6 as $key => $day6_data) {
                      echo "<th>{$day6_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;">اليوم  السابع</th>
                    </tr>
                    <tr>
                         <th scope="col">وجبة الفطور</th>
                        <th scope="col">سناك 1</th>

                        <th scope="col">وجبة الغداء </th>
                        <th scope="col">سناك 2 </th>

                        <th scope="col">وجبة العشاء </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php 
                  usort($diets_data_day7, function($a, $b) {
                    return $a[0]['course'] - $b[0]['course'];
                });
                  foreach ($diets_data_day7 as $key => $day7_data) {
                      echo "<th>{$day7_data[0]['diet_title']}</th>";
                  }
              ?>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <!-- Centered, larger font, and yellow background -->
                        <th scope="col" colspan="5" class="centered-th text-center"
                            style="background-color: #f8cc00; font-size: 12px;color: black;"> قيم غذائية </th>
                    </tr>
                    <tr>
                        <td>كالوري</td>
                        <td>كربوهيدرات</td>
                        <td>بروتين</td>
                        <td>دهون</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $program_data["calories"]?></td>
                        <td><?php echo $program_data["carbs"]?></td>
                        <td><?php echo $program_data["protein"]?></td>
                        <td><?php echo $program_data["fat"]?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     <script>
        setTimeout(() => {
            var element = document.getElementById("element");

            var opt = {
                margin: 0,
                filename: "myfile.pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { orientation: "portrait" },
            };

            html2pdf()
                .set(opt)
                .from(element)
                .toPdf()
                .get("pdf")
                .then(function (pdf) {
                    // Open the PDF in the current window/tab
                    window.open(pdf.output("bloburl"), "_self");
                });
        }, 1000);
    </script>  
</body>

</html>
