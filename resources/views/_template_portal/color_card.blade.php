@extends('_template_portal._layouts.main')

<!-- ================== page-css ================== -->
@section('page-css')
    <!--  -->
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/index.css" />
    <link type="text/css" rel="stylesheet" href="/portal_assets/css/reset.css" />
    <style type="text/css">
		@media screen and (min-width: 481px) {
			.wrap {
				display: block;
				width: 100%;
				margin: auto;
			}
			header{
				display: block;
				width: 100%;
				height: 30px;
			}
			header h1{
				text-align: center;
				padding-top: 20px;
				font-size: 1.5em;
			}
			.flex_center {
				display: -webkit-flex;
				display: flex;
				display: -ms-flexbox;
				-webkit-align-items: center;
				align-items: center;
				-webkit-justify-content: center;
				justify-content: center;
				-ms-flex-align: center;
				-ms-flex-pack: center;
			}
			.flex_flow {
				-webkit-flex-flow: wrap row;
				flex-flow: wrap row;
			}
			.row_outside{
				width: 100%;
				margin: 25px auto;
			}
			.row_block{
				float: left;
				width: 15%;
				margin: 1%;
				text-align: center;
			}
			.row_block img{
				max-width: 200px;
				height: 70px;
				-moz-box-shadow: 5px 6px 10px #000000;
				-webkit-box-shadow: 5px 6px 10px #000000;
				box-shadow: 5px 6px 10px #000000;
			}
			.row_block h2{
				padding-top: 10px;
			}
		}
		@media screen and (max-width: 480px) {
			.wrap {
				display: block;
				width: 100%;
				max-width: 480px;
				margin: auto;
			}
			header{
				display: block;
				width: 100%;
				height: 30px;
			}
			header h1{
				text-align: center;
				padding-top: 20px;
				font-size: 1em;
				display: block;
				padding-left: -5px;
			}
			.flex_center {
				display: -webkit-flex;
				display: flex;
				display: -ms-flexbox;
				-webkit-align-items: center;
				align-items: center;
				-webkit-justify-content: center;
				justify-content: center;
				-ms-flex-align: center;
				-ms-flex-pack: center;
			}
			.flex_flow {
				-webkit-flex-flow: wrap row;
				flex-flow: wrap row;
			}
			.row_outside{
				width: 100%;
				margin: 25px auto;
			}
			.row_block{
				float: left;
				width: 50%;
				margin: 0%;
			}
			.row_block img{
				max-width: 100%;
				height: 85px;
				-moz-box-shadow: 0px 7px 15px #000000;
				-webkit-box-shadow: 0px 7px 15px #000000;
				box-shadow: 0px 7px 15px #000000;
			}
			.row_block h2{
				padding-top: 15px;
				padding-bottom: 30px;
				text-align: center;
				
			}
		}

		#p1{
			font-size: 13px;
			color: red;
			text-align: center;
			margin-top: 20px;
		}
	</style>
@endsection
<!-- ================== /page-css ================== -->
@section('title', 'Color Card')
<!-- content -->
@section('content')
    <div class="mainContent">
        <div class="content">
            <div class="wrap">
				<header>
					<h1>色卡比對資料</h1>
				</header>

				<div class="row_outside flex_center flex_flow">
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/02.jpg">
						<h2>02</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/03.jpg">
						<h2>03</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/04.jpg">
						<h2>04</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/05.jpg">
						<h2>05</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/06.jpg">
						<h2>06</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/07.jpg">
						<h2>07</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/08.jpg">
						<h2>08</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/09.jpg">
						<h2>09</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/10.jpg">
						<h2>10</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/11.jpg">
						<h2>11</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/12.jpg">
						<h2>12</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/13.jpg">
						<h2>13</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/14.jpg">
						<h2>14</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/15.jpg">
						<h2>15</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/16.jpg">
						<h2>16</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/17.jpg">
						<h2>17</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/18.jpg">
						<h2>18</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/19.jpg">
						<h2>19</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/20.jpg">
						<h2>20</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/21.jpg">
						<h2>21</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/22.jpg">
						<h2>22</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/23.jpg">
						<h2>23</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/24.jpg">
						<h2>24</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/25.jpg">
						<h2>25</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/26.jpg">
						<h2>26</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/27.jpg">
						<h2>27</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/28.jpg">
						<h2>28</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/29.jpg">
						<h2>29</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/30.jpg">
						<h2>30</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/31.jpg">
						<h2>31</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/32.jpg">
						<h2>32</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/33.jpg">
						<h2>33</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/34.jpg">
						<h2>34</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/35.jpg">
						<h2>35</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/36.jpg">
						<h2>36</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/37.jpg">
						<h2>37</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/38.jpg">
						<h2>38</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/39.jpg">
						<h2>39</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/40.jpg">
						<h2>40</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/41.jpg">
						<h2>41</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/42.jpg">
						<h2>42</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/43.jpg">
						<h2>43</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/44.jpg">
						<h2>44</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/45.jpg">
						<h2>45</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/46.jpg">
						<h2>46</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/47.jpg">
						<h2>47</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/48.jpg">
						<h2>48</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/49.jpg">
						<h2>49</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/50.jpg">
						<h2>50</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/51.jpg">
						<h2>51</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/52.jpg">
						<h2>52</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/53.jpg">
						<h2>53</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/54.jpg">
						<h2>54</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/55.jpg">
						<h2>55</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/56.jpg">
						<h2>56</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/57.jpg">
						<h2>57</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/58.jpg">
						<h2>58</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/59.jpg">
						<h2>59</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/60.jpg">
						<h2>60</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/61.jpg">
						<h2>61</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/62.jpg">
						<h2>62</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/63.jpg">
						<h2>63</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/64.jpg">
						<h2>64</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/65.jpg">
						<h2>65</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/66.jpg">
						<h2>66</h2>
					</div>			
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/67.jpg">
						<h2>67</h2>
					</div>			
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/68.jpg">
						<h2>68</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/69.jpg">
						<h2>69</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/70.jpg">
						<h2>70</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/71.jpg">
						<h2>71</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/72.jpg">
						<h2>72</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/73.jpg">
						<h2>73</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/74.jpg">
						<h2>74</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/75.jpg">
						<h2>75</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/76.jpg">
						<h2>76</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/77.jpg">
						<h2>77</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/78.jpg">
						<h2>78</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/79.jpg">
						<h2>79</h2>
					</div>	
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/80.jpg">
						<h2>80</h2>
					</div>
					<div class="row_block">	
						<img src="/portal_assets/images/color_card/81.jpg">
						<h2>81</h2>
					</div>
					<p id="p1">因各廠牌手機螢幕解析度有色調的不同，所以螢幕顯示的顏色與實品會有些許的差異，實際顏色以實品筆頭所附的色澤為準。</p>
				</div>
				<p class="clearfix"></h2>	
			</div>
        </div> 
    </div>
@endsection
<!-- /content -->

<!-- ================== page-js ================== -->
@section('page-js')
    <!--  -->
@endsection
<!-- ================== /page-js ================== -->
<!-- ================== inline-js ================== -->
@section('inline-js')
    <!--  -->
@endsection
<!-- ================== /inline-js ================== -->
