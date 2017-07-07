@extends('partial.layout')

@section('style')
  <style>
    /*body{*/
      /*background-color: #f5f5d5;*/
      /*padding: 30px 0;*/
    /*}*/
    .left{
      width: 800px;
      height: 100%;
      display: block;
    }
    .left a:hover{
      color: #23527c;
    }
    section{
      display: block;
      float: left;
      width: 800px;

      padding: 0;
      margin: 30px 0 0;

      box-sizing: border-box;
      border: 1px #ccc solid;
    }
    section:not(:first-child){
      margin: 27px 0 0;
    }
    section .title{
      width: 800px;
      height: 70px;
      float: left;
    }
    section .title .date{
      width: 62px;
      height: 65px;
      float: left;

      padding: 11px 8px;
      margin: 0 0 0 17px;

      background-color: #333;
      color: #fff;
      font-size: 16px;
    }
    section .title h2{
      margin: 0;
      height: 45px;
      width: 721px;
      float: left;
      /*margin-right: 17px;*/
      padding: 0 17px;

      line-height: 45px;
      overflow: hidden;
      font-size: 24px;

      /*border: 1px solid rebeccapurple;*/
      display: inline-block;
    }
    section .title h2 a{
      color: #333;
      text-decoration: none;
    }
    section .title h2 a:hover{
      /*color: #333;*/
      text-decoration: none;
    }
    section .title span{
      display: inline-block;
      margin: 0;
      height: 20px;
      width: 721px;
      float: left;
      padding: 0 17px;

      line-height: 20px;
      overflow: hidden;
      font-size: 14px;

      color: #666;
    }

    section .cover{
      float: left;
      padding: 0;
      margin: 0 17px;
      width: 764px;
      height: 270px;

      /*border: 1px solid firebrick;*/
    }
    section .cover > img{
      padding: 0;
      margin: 0;
      width: 100%;
      height: 100%;
    }
    section .information{
      width: 100%;
      float: left;
      margin: 7px 0 10px;
      padding: 0 17px;
    }
    section .information > p{
      margin: 0;
      padding: 0;

      color: #666;
      line-height: 24px;
      text-align: justify;
    }
    section .go{
      margin-top: 7px;
      float: right;
    }
    section .go > a{
      color: #333;
    }
    section .go > a:hover{
      text-decoration: none;
    }
    .right{
      display: block;
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="left">
        @foreach($articles as $article)
          <section>
            <div class="title">
              <div class="date">
                <small>{{ $article->created_at->format('Y') }}</small>
                {{ $article->created_at->format('m-d') }}
              </div>
              <h2><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h2>
              <span>来源：原创   分类：交互设计, 网页设计</span>
            </div>
            <div class="cover">
              <img src="{{ $article->cover }}" title="{{ $article->title }}" alt="{{ $article->title }}">
            </div>
            <div class="information">
              <p>{{ $article->abstract }}</p>
              <span class="go"><a href="/article/{{ $article->id }}">阅读全文 &gt;&gt;</a></span>
            </div>
          </section>
        @endforeach
    </div>
    <div class="right">
        <ul style="margin: 0;padding: 0;border: 1px solid navy">
          @foreach($articles as $article)
            <li><a href="/article/{{ $article->id }}">{{ $article->title }}</a></li>
          @endforeach
        </ul>
    </div>
  </div>
@endsection
