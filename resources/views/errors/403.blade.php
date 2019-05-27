@extends('errors::vulcano')

@section('title', __('Acesso Negado'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Acesso Negado'))
@section('text', __('Lamento, mas você não tem acesso a este recurso do sistema.'))
