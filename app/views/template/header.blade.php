<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Appboard - Admin Template with Angularjs">
    <meta name="keywords" content="appboard, webapp, admin, dashboard, template, ui">
    <meta name="author" content="solutionportal">
    <!-- <base href="/"> -->
    @yield('titulo')
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Icons -->
    <link rel="stylesheet" href="assets/fonts/font-awesome/font-awesome.css">

    <!-- Css/Less Stylesheets -->
    <link rel="stylesheet" href="assets/styles/vendors/bootstrap.min.css">
    <link rel="stylesheet/less" href="assets/styles/main.less">

    <!-- Set this in dist folder in index.html file -->
    <!--    <link rel="stylesheet" href="styles/bootstrap.min.css">
            <link rel="stylesheet" href="styles/main.min.css">
        -->

    <!-- Match Media polyfill for IE9 -->
    <!--[if IE 9]><!--> <script src="assets/scripts/ie/matchMedia.js"></script>  <!--<![endif]-->

</head>
@extends('template.body')