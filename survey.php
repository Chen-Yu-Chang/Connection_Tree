<?php

    session_start();
    if(isset($_POST['continue'])){
        $_SESSION['input_name'] = $_POST['input_name'];
        $_SESSION['input_email'] = $_POST['input_email'];
    }
    //survey.php
    $error = '';
    $name = '';
    $email = '';
    $q1 = '';
    $gender = '';
    $relation = '';
    $time = '';
    $frequency = '';
    $advice = '';
    $truth = '';
    $job = '';
    $help = '';
    $contact = '';
    $rate = '';
    $rate1 = '';
    $message = '';

    function clean_text($string)
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    if(isset($_POST["submit"])||isset($_POST["add"]))
    {
        if(empty($_SESSION['input_name']))
        {
            $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
        }
        else
        {
            $name = clean_text($_SESSION['input_name']);
            if(!preg_match("/^[a-zA-Z ]*$/",$name))
            {
                $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
            }
        }
        if(empty($_SESSION['input_email']))
        {
            $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
        }
        else
        {
            $email = clean_text($_SESSION['input_email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error .= '<p><label class="text-danger">Invalid email format</label></p>';
            }
        }
        if(empty($_POST["q1"]))
        {  
            $error .= '<p><label class="text-danger">Who you go to is required</label></p>';
        }
        else
        {
            $q1 = clean_text($_POST["q1"]);
        }
        if(empty($_POST["gender"]))
        {
            $error .= '<p><label class="text-danger">Gender is required</label></p>';
        }
        else
        {
            $gender = clean_text($_POST["gender"]);
        }
        if(empty($_POST["relation"]))
        {
            $error .= '<p><label class="text-danger">Relationship is required</label></p>';
        }
        else
        {
            $relation = clean_text($_POST["relation"]);
        }
        if(empty($_POST["time"]))
        {
            $error .= '<p><label class="text-danger">Length of time is required</label></p>';
        } 
        else
        {
            $time = clean_text($_POST["time"]);
        }
        if(empty($_POST["frequency"]))
        {
            $error .= '<p><label class="text-danger">Frequency is required</label></p>';
        } 
        else
        {
            $frequency = clean_text($_POST["frequency"]);
        }
        if(empty($_POST["advice"]))
        {
            $error .= '<p><label class="text-danger">Advice is required</label></p>';
        } 
        else
        {
            $advice = clean_text($_POST["advice"]);
        }
        if(empty($_POST["truth"]))
        {
            $error .= '<p><label class="text-danger">Truth is required</label></p>';
        } 
        else
        {
            $truth = clean_text($_POST["truth"]);
        }
        if(empty($_POST["job"]))
        {
            $error .= '<p><label class="text-danger">Job is required</label></p>';
        } 
        else
        {
            $job = clean_text($_POST["job"]);
        }
        if(empty($_POST["help"]))
        {
            $error .= '<p><label class="text-danger">Help is required</label></p>';
        } 
        else
        {
            $help = clean_text($_POST["help"]);
        }
        if(empty($_POST["contact"]))
        {
            $error .= '<p><label class="text-danger">Contact is required</label></p>';
        } 
        else
        {
            $contact = clean_text($_POST["contact"]);
        }
        if(empty($_POST["rate"]))
        {
            $error .= '<p><label class="text-danger">Rate is required</label></p>';
        } 
        else
        {
            $rate = clean_text($_POST["rate"]);
        }
        if(empty($_POST["rate1"]))
        {
            $error .= '<p><label class="text-danger">Rate1 is required</label></p>';
        } 
        else
        {
            $rate1 = clean_text($_POST["rate1"]);
        }
        if(empty($_POST["message"]))
        {
            $error .= '<p><label class="text-danger">Feedback is required</label></p>';
        } 
        else
        {
            $message = clean_text($_POST["message"]);
        }

        if($error == '')
        {
            $file_open = fopen("connection_data.csv", "a");
            $no_rows = count(file("connection_data.csv"));
            if($no_rows > 1)
            {
                $no_rows = ($no_rows - 1) + 1;
            }
            $form_data = array(
                'sr_no'  => $no_rows,
                'name'  => $name,
                'email'  => $email,
                'q1' => $q1,
                'gender' => $gender,
                'relation' => $relation,
                'time' => $time,
                'frequency' => $frequency,
                'advice' => $advice,
                'truth' => $truth,
                'job' => $job,
                'help' => $help,
                'rate' => $rate,
                'rate1' => $rate1,
                'message' => $message
            );
            fputcsv($file_open, $form_data);
            $error = '<label class="text-success">Thank you for filling the survey</label>';
            $name = '';
            $email = '';
            $q1 = '';
            $gender = '';
            $relation = '';
            $time = '';
            $frequency = '';
            $advice = '';
            $truth = '';
            $job = '';
            $help = '';
            $rate = '';
            $rate1 = '';
            $message = '';
            if (isset($_POST["submit"])){
                session_destroy();
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Connection Tree</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <br />
    <div class="container">
        <h2 align="center">Create Your Own Connection Tree</h2>
        <br />
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="post">
                <h3 align="center">Connection Survey</h3>
                <br />
                <?php echo $error; ?>
                <div class="form-group">
                <label>Who do you go to for support?</label>
                <input type="text" name="q1" class="form-control" placeholder="Enter Name" value="<?php echo $q1; ?>" />
        </div><br>
        <div class="form-group">
            <label>What is that person's gender</label><br>
            <input type="radio" name="gender"
            <?php if (isset($gender) && $gender=="female") echo "checked";?>
            value="female"> Female
            <input type="radio" name="gender"
            <?php if (isset($gender) && $gender=="male") echo "checked";?>
            value="male"> Male
            <input type="radio" name="gender"
            <?php if (isset($gender) && $gender=="other") echo "checked";?>
            value="other"> Other
        </div><br>
        <div class="form-group">
            <label>Who is this person to you?</label>
            <select name="relation">
                <option value=""><--Choose--></option> 
                <option value="Parent/Step-parent/Guardian">Parent/Step-parent/Guardian</option>  
                <option value="Siblings">Siblings</option>  
                <option value="Other family members">Other family members</option>  
                <option value="Significant others/Romantic partner">Significant others/Romantic partner</option>  
                <option value="School adults">School adults</option>  
                <option value="Friend">Friend</option>  
                <option value="Family friend">Family friend</option>  
                <option value="Mentor">Mentor</option>
                <option value="Neighbor">Neighbor</option>
                <option value="Co-worker">Co-worker</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Adult at a place of worship">Adult at a place of worship</option>
                <option value="Others">Others</option>
            </select> 
        </div><br>
        <div class="form-group">
            <label>How long have you known this person?</label><br>
            <input type="radio" name="time"
            <?php if (isset($time) && $time=="less than 6 months") echo "checked";?>
            value="less than 6 months"> Less than 6 months
            <input type="radio" name="time"
            <?php if (isset($time) && $time=="6 months to a year") echo "checked";?>
            value="6 months to a year"> 6 months to a year
            <input type="radio" name="time"
            <?php if (isset($time) && $time=="1 year to 3 years") echo "checked";?>
            value="1 year to 3 years"> 1 year to 3 years
            <input type="radio" name="time"
            <?php if (isset($time) && $time=="More than 3 years") echo "checked";?>
            value="More than 3 years"> More than 3 years
        </div><br>
        <div class="form-group">
            <label>How often do you feel like this person listens to you when you need to talk?</label><br>
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="Never") echo "checked";?>
            value="Never"> Never
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="Less than once per year") echo "checked";?>
            value="Less than once per year"> Less than once per year
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="A few times a year") echo "checked";?>
            value="A few times a year"> A few times a year
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="A few times a month") echo "checked";?>
            value="A few times a month"> A few times a month <br>
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="At least once per week") echo "checked";?>
            value="At least once per week"> At least once per week
            <input type="radio" name="frequency"
            <?php if (isset($frequency) && $frequency=="Almost every day") echo "checked";?>
            value="Almost every day"> Almost every day
        </div><br>
        <div class="form-group">
            <label>How often do you feel like this person gives you good advice/information about your work or future career plans?</label><br>
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="Never") echo "checked";?>
            value="Never"> Never
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="Less than once per year") echo "checked";?>
            value="Less than once per year"> Less than once per year
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="A few times a year") echo "checked";?>
            value="A few times a year"> A few times a year
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="A few times a month") echo "checked";?>
            value="A few times a month"> A few times a month <br>
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="At least once per week") echo "checked";?>
            value="At least once per week"> At least once per week
            <input type="radio" name="advice"
            <?php if (isset($advice) && $advice=="Almost every day") echo "checked";?>
            value="Almost every day"> Almost every day
        </div><br>
        <div class="form-group">
            <label>How often does this person tell you the truth about how you did on things?</label><br>
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="Never") echo "checked";?>
            value="Never"> Never
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="Less than once per year") echo "checked";?>
            value="Less than once per year"> Less than once per year
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="A few times a year") echo "checked";?>
            value="A few times a year"> A few times a year
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="A few times a month") echo "checked";?>
            value="A few times a month"> A few times a month <br>
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="At least once per week") echo "checked";?>
            value="At least once per week"> At least once per week
            <input type="radio" name="truth"
            <?php if (isset($truth) && $truth=="Almost every day") echo "checked";?>
            value="Almost every day"> Almost every day
        </div><br>
        <div class="form-group">
            <label>How often do you feel like this person gives you practical job- or career-related help? For example, by helping you apply for a job, looking over your resume, or taking you to an interview.</label><br>
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="Never") echo "checked";?>
            value="Never"> Never
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="Less than once per year") echo "checked";?>
            value="Less than once per year"> Less than once per year
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="A few times a year") echo "checked";?>
            value="A few times a year"> A few times a year
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="A few times a month") echo "checked";?>
            value="A few times a month"> A few times a month <br>
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="At least once per week") echo "checked";?>
            value="At least once per week"> At least once per week
            <input type="radio" name="job"
            <?php if (isset($job) && $job=="Almost every day") echo "checked";?>
            value="Almost every day"> Almost every day
        </div><br>
        <div class="form-group">
            <label>To what degree do you trust this person to help you when you need it?</label><br>
            <input type="radio" name="help"
            <?php if (isset($help) && $help=="Not at all") echo "checked";?>
            value="Not at all"> Not at all
            <input type="radio" name="help"
            <?php if (isset($help) && $help=="A small amount") echo "checked";?>
            value="A small amount"> A small amount
            <input type="radio" name="help"
            <?php if (isset($help) && $help=="A fair amount") echo "checked";?>
            value="A fair amount"> A fair amount
            <input type="radio" name="help"
            <?php if (isset($help) && $help=="A great deal") echo "checked";?>
            value="A great deal"> A great deal
        </div><br>
        <div class="form-group">
            <label>How do you primarily connect with this person?</label>
            <select name="contact">
                <option value=""><--Choose--></option> 
                <option value="In Person">In Person</option>  
                <option value="Talk on the phone (i.e., voice call)">Talk on the phone (i.e., voice call)</option>  
                <option value="Text">Text</option>  
                <option value="Through a social networking application (e.g., Facebook, Snapchat, Instagram)">Through a social networking application (e.g., Facebook, Snapchat, Instagram)</option>  
                <option value="Email">Email</option>  
                <option value="Others">Others</option>
            </select> 
        </div><br>
        <div class="form-group">
            <label>Rate how much you agree with the following statement: I can be myself with this person.</label><br>
            <input type="radio" name="rate"
            <?php if (isset($rate) && $rate=="Strongly Disagree") echo "checked";?>
            value="Strongly Disagree"> Strongly Disagree
            <input type="radio" name="rate"
            <?php if (isset($rate) && $rate=="Somewhat Disagree") echo "checked";?>
            value="Somewhat Disagree"> Somewhat Disagree
            <input type="radio" name="rate"
            <?php if (isset($rate) && $rate=="Neither Agree Nor Disagree") echo "checked";?>
            value="Neither Agree Nor Disagree"> Neither Agree Nor Disagree<br>
            <input type="radio" name="rate"
            <?php if (isset($rate) && $rate=="Somewhat Agree") echo "checked";?>
            value="Somewhat Agree"> Somewhat Agree
            <input type="radio" name="rate"
            <?php if (isset($rate) && $rate=="Strongly Agree") echo "checked";?>
            value="Strongly Agree"> Strongly Agree
        </div><br>
        <div class="form-group">
            <label>This person is able to financially assist me with the costs of pursuing my future career path</label><br>
            <input type="radio" name="rate1"
            <?php if (isset($rate1) && $rate1=="Strongly Disagree") echo "checked";?>
            value="Strongly Disagree"> Strongly Disagree
            <input type="radio" name="rate1"
            <?php if (isset($rate1) && $rate1=="Somewhat Disagree") echo "checked";?>
            value="Somewhat Disagree"> Somewhat Disagree
            <input type="radio" name="rate1"
            <?php if (isset($rate1) && $rate1=="Neither Agree Nor Disagree") echo "checked";?>
            value="Neither Agree Nor Disagree"> Neither Agree Nor Disagree<br>
            <input type="radio" name="rate1"
            <?php if (isset($rate1) && $rate1=="Somewhat Agree") echo "checked";?>
            value="Somewhat Agree"> Somewhat Agree
            <input type="radio" name="rate1"
            <?php if (isset($rate1) && $rate1=="Strongly Agree") echo "checked";?>
            value="Strongly Agree"> Strongly Agree
        </div><br>
        <div class="form-group">
            <label>Feedbacks for Our Web</label>
            <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
        </div>

        <div class="form-group" align="center">
            <input type="submit" name="submit" class="btn btn-info" value="Submit" />
            <input type="submit" name="add" class="btn btn-info" value="Add New Connection"/>
            <input type="submit" name="graph" class="btn btn-info" value="See Graph" />
        </div>
        </form>
   </div>
  </div>
 </body>
</html>