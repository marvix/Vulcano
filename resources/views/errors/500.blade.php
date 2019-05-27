@extends('errors::minimal')

@section('title', __('Erro do Servidor'))
@section('code', '500')
@section('message', __('Erro do Servidor'))
@section('text', __('Houve algum erro nos nossos servidores. Tente novamente em alguns instantes.'))
