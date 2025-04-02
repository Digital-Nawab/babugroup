<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }
        .email-header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .email-body {
            padding: 20px;
            line-height: 1.8;
        }
        .email-body p {
            font-size: 16px;
        }
        .details-list {
            list-style-type: none;
            padding: 0;
        }
        .details-list li {
            font-size: 16px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 5px;
        }
        .login-btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 20px 0;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }
        .login-btn:hover {
            background-color: #45A049;
        }
        .email-footer {
            font-size: 14px;
            color: #777;
            text-align: center;
            padding: 10px;
        }

        /* Media Queries for Responsive Design */
        @media screen and (max-width: 600px) {
            .email-container {
                padding: 15px;
            }
            .email-header {
                font-size: 20px;
                padding: 15px;
            }
            .email-body {
                padding: 15px;
            }
            .details-list li {
                font-size: 14px;
                padding: 8px;
            }
            .login-btn {
                padding: 10px 20px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 400px) {
            .email-header {
                font-size: 18px;
            }
            .login-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="email-container">
    <div class="email-header">
        Welcome, {{ $student->student_name }}!
    </div>
    <div class="email-body">
        <p>Your registration has been approved. Here are your login details:</p>
        <ul class="details-list">
            <li><strong>Student Register ID:</strong> {{ $student->student_register_id }}</li>
            <li><strong>University Enrollment No:</strong> {{ $student->university_enrolment_no }}</li>
            <li><strong>Password:</strong> {{ $password }}</li>
        </ul>
        <p>
            Click below to access your account:
        </p>
        <a href="{{ url('/login') }}" class="login-btn">Login to Your Account</a>
        <p>Thank you for choosing our institution!</p>
    </div>
    <div class="email-footer">
        &copy; {{ date('Y') }} Your College Name. All Rights Reserved.
    </div>
</div>

</body>
</html>
