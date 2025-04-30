<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Exam Result</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Exam Result </li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="col-md-12">
        <div class="card-body">
      
        <div class="row">
                        <div class="col-md-3">
                           <div class="form-group ">
                              <label for="content" class="col-sm-3 control-label">Course: </label>

                              <div class="col-sm-9">
                                 <?php echo $exam_detail->course_name; ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group ">
                              <label for="content" class="col-sm-7 control-label">No of Question: </label>

                              <div class="col-sm-5">
                                 <?php echo $exam_detail->total_questions; ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group ">
                              <label for="content" class="col-sm-7 control-label">Full Marks: </label>

                              <div class="col-sm-5">
                                 <?php echo $exam_detail->full_marks; ?>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group ">
                              <label for="content" class="col-sm-7 control-label">Pass Marks: </label>

                              <div class="col-sm-5">
                                 <span class="detail_group-no_of_options"><?= _ent($exam_detail->pass_marks); ?></span>
                              </div>
                           </div>
                        </div>
                     </div>

                     <hr>
                     <div class="row">
                        <?php $sn = 0;
                        $question_detail =  json_decode($exam_detail->questions);
                        $correct_ans = json_decode($exam_detail->correct_ans);
                        $wrong_ans = json_decode($exam_detail->wrong_ans);
                        $not_ans = json_decode($exam_detail->not_ans);
                        foreach ($question_detail as $data) {
                           $detail = get_qustion_detail($data);
                           $ans_detail =   getAnswer_detail($data, $correct_ans, $wrong_ans, $not_ans);
                           $sn++; ?>
                           <div class="col-md-12">
                              <table>
                                 <tbody>
                                    <tr>
                                       <td><?php echo $sn . ')  '; ?></td>
                                       <td colspan="2"><?php echo $detail->question; ?></td>
                                    </tr>
                                    <tr>
                                       <td></td>
                                       <td>
                                          <p class="options-para"><input type="radio" <?php if ($detail->correct_option == 1) {
                                                                                          echo "checked";
                                                                                       } ?>> <?php echo $detail->option_1; ?></p>
                                       </td>
                                    </tr>
                                    <?php if ($detail->no_of_options == 2 || $detail->no_of_options == 3 || $detail->no_of_options == 4) { ?>
                                       <tr>
                                          <td></td>
                                          <td>
                                             <p class="options-para"><input type="radio" <?php if ($detail->correct_option == 2) {
                                                                                             echo "checked";
                                                                                          } ?>> <?php echo $detail->option_2; ?></p>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                    <?php if ($detail->no_of_options == 3 || $detail->no_of_options == 4) { ?>
                                       <tr>
                                          <td></td>
                                          <td>
                                             <p class="options-para"><input type="radio" <?php if ($detail->correct_option == 3) {
                                                                                             echo "checked";
                                                                                          } ?>> <?php echo $detail->option_3; ?></p>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                    <?php if ($detail->no_of_options == 4) { ?>
                                       <tr>
                                          <td></td>
                                          <td>
                                             <p class="options-para"><input type="radio" <?php if ($detail->correct_option == 4) {
                                                                                             echo "checked";
                                                                                          } ?>> <?php echo $detail->option_4; ?></p>
                                          </td>
                                       </tr>

                                    <?php } ?>
                                    <tr>
                                       <td>Your Answer:</td>
                                       <td><?php if ($ans_detail == "correct") {
                                           echo "correct";
                                                         } elseif ($ans_detail == "wrong") {
                                                            $res = get_wrong_ans_detail($id,$data);
                                                            echo $res->ans;
                                                         } elseif ($ans_detail == "not_answered") {
                                                            echo "Not Answered";
                                                         } else {
                                                         } ?> </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                           <hr>
                        <?php } ?>


                     </div>
              
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    </div>
    </div>
  </section>
  <!-- /.content -->
</div>

<?php function getAnswer_detail($questionNumber, $correctAnswers, $wrongAnswers, $notAnswered)
{
   if (in_array($questionNumber, $correctAnswers)) {
      return 'correct';
   } elseif (in_array($questionNumber, $wrongAnswers)) {
      return 'wrong';
   } elseif (in_array($questionNumber, $notAnswered)) {
      return 'not_answered';
   }
   return '';
} ?>

