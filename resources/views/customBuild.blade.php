@extends('layouts.main')

@section('content')



<!-- META TAGS -->

@section('pageTitle',$pageTitle)

@section('pagedescription',$pagedescription)

@section('Keywords',$pagetags)





<!-- ============================================================== -->

<!-- BODY START HERE -->

<!-- ============================================================== -->



    <!-- banner start -->

    <!--<section class="inner-banner">-->

    <!--    <div class="inner-abnner-mn">-->

    <!--        <img src="{{asset($banner->image)}}" class="img-fluid inner-banner-img" alt="...">-->

    <!--        <div class="inr-bnr-txt-mn">-->

    <!--            <div class="container">-->

    <!--                <div class="row">-->

    <!--                    <div class=" col-md-12 col-lg-6">-->

    <!--                        <div class="inner-banner wow fadeInLeft" data-wow-duration="2s">-->

    <!--                            <h2>Custom Build</h2>-->

    <!--                        </div>-->

    <!--                    </div>-->

    <!--                    <div class=" col-md-12 col-lg-6">-->



    <!--                    </div>-->

    <!--                </div>-->

    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->

    <!--</section>-->

    <!-- banner end -->

    

    <div class="Builder-wrapper">

        <div class="container">

            <div class="row justify-content-center">

                <div class="side-model-selector">

                    <div class="accordion" id="accordionExample">

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="headingThree">

                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

                                Model

                              </button>

                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Chateau Hood</span>

                                            <i class="fas fa-check-circle"></i>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="headingOne">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Color</button>

                            </h2>

                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Standard Colors</a>

                                        </li>

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Premium</a>

                                        </li>

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Deluxe Colors</a>

                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="color-opt active" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model1.jpg" style="background-color: #415180; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>Royal Blue</span>

                                                    </div>

                                                </div>

                                                <div class="option-btn">

                                                    <div class="color-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model2.jpg" style="background-color: #000101; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>Brilliant Black</span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="color-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model3.jpg" style="background-color: #002c1c; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>British Racing Green</span>

                                                    </div>

                                                </div>

                                                <div class="option-btn">

                                                    <div class="color-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model4.jpg" style="background-color: #452146; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>Eggplant</span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="color-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model5.jpg" style="background-color: #9b3921; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>Tomato</span>

                                                    </div>

                                                </div>

                                                <div class="option-btn">

                                                    <div class="color-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/model6.jpg" style="background-color: #83cfc7; color:#fff;">

                                                        <i class="fas fa-check-circle"></i>

                                                        <span>Aquamarine Blue</span>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="headingTwo">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Trim</button>

                            </h2>

                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">Standard Trims</a>

                                        </li>

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">Premium Trims</a>

                                        </li>

                                        <li class="nav-item" role="presentation">

                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact1" role="tab" aria-controls="contact" aria-selected="false">Copper Trims</a>

                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent">

                                        <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="trim-opt active" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/trm3.png">

                                                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim3.jpg" alt="">

                                                        <span>Brushed Stainless Steel Trim</span>

                                                        <i class="fas fa-check-circle"></i>

                                                    </div>

                                                </div>

                                                <div class="option-btn">

                                                    <div class="trim-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/trm4.png">

                                                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim4.jpg" alt="">

                                                        <span>Polished Brass Trim</span>

                                                        <i class="fas fa-check-circle"></i>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="trim-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/trm5.png">

                                                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim5.jpg" alt="">

                                                        <span>Matte Black Trim</span>

                                                        <i class="fas fa-check-circle"></i>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab">

                                            <div class="selectr-grid">

                                                <div class="option-btn">

                                                    <div class="trim-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/trm1.png">

                                                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim1.jpg" alt="">

                                                        <span>Polished Copper Trim</span>

                                                        <i class="fas fa-check-circle"></i>

                                                    </div>

                                                </div>

                                                <div class="option-btn">

                                                    <div class="trim-opt" data-img-src="https://demo-customlinks.com/modernaire/public/images/models/trm2.png">

                                                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim2.jpg" alt="">

                                                        <span>Brushed Copper Trim</span>

                                                        <i class="fas fa-check-circle"></i>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="headingFour">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">

                                Overall Dimensions

                              </button>

                            </h2>

                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Bottom Depth</span>

                                            <!--<select>-->

                                            <!--    <option>18</option>-->

                                            <!--    <option>19</option>-->

                                            <!--    <option>20</option>-->

                                            <!--    <option>21</option>-->

                                            <!--    <option>22</option>-->

                                            <!--    <option>23</option>-->

                                            <!--    <option selected>24</option>-->

                                            <!--    <option>25</option>-->

                                            <!--    <option>26</option>-->

                                            <!--    <option>27</option>-->

                                            <!--    <option>28</option>-->

                                            <!--    <option>29</option>-->

                                            <!--    <option>30</option>-->

                                                

                                            <!--</select>-->

                                            <div class="range_wrap">

                                                <span class="rangeValue">18</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                    <Input class="range" type="range" value="24" min="18" max="30"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            

                                        </div>

                                    </div>

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Bottom Width</span>

                                            <!--<select>-->

                                            <!--    <option>30</option>-->

                                            <!--    <option>31</option>-->

                                            <!--    <option>32</option>-->

                                            <!--    <option>33</option>-->

                                            <!--    <option>34</option>-->

                                            <!--    <option>35</option>-->

                                            <!--    <option selected>36</option>-->

                                            <!--    <option>37</option>-->

                                            <!--    <option>38</option>-->

                                            <!--    <option>39</option>-->

                                            <!--    <option>40</option>-->

                                            <!--    <option>41</option>-->

                                            <!--    <option>42</option>-->

                                            <!--    <option>43</option>-->

                                            <!--    <option>44</option>-->

                                            <!--    <option>45</option>-->

                                            <!--    <option>46</option>-->

                                            <!--    <option>47</option>-->

                                            <!--    <option>48</option>-->

                                            <!--    <option>49</option>-->

                                            <!--    <option>50</option>-->

                                            <!--    <option>51</option>-->

                                            <!--    <option>52</option>-->

                                            <!--    <option>53</option>-->

                                            <!--    <option>54</option>-->

                                            <!--    <option>55</option>-->

                                            <!--    <option>56</option>-->

                                            <!--    <option>57</option>-->

                                            <!--    <option>58</option>-->

                                            <!--    <option>59</option>-->

                                            <!--    <option>60</option>-->

                                            <!--    <option>61</option>-->

                                            <!--    <option>62</option>-->

                                            <!--    <option>63</option>-->

                                            <!--    <option>64</option>-->

                                            <!--    <option>65</option>-->

                                            <!--    <option>66</option>-->

                                            <!--    <option>67</option>-->

                                            <!--    <option>68</option>-->

                                            <!--    <option>69</option>-->

                                            <!--    <option>70</option>-->

                                            <!--    <option>71</option>-->

                                            <!--    <option>72</option>-->

                                            <!--</select>-->

                                            <div class="range_wrap">

                                                <span class="rangeValue">30</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="36" min="30" max="72"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Top Depth</span>

                                            <div class="range_wrap">

                                                <span class="rangeValue">12</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="12" min="12" max="16"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            <!--<select>-->

                                            <!--    <option selected>12</option>-->

                                            <!--    <option>13</option>-->

                                            <!--    <option>14</option>-->

                                            <!--    <option>15</option>-->

                                            <!--    <option>16</option>-->

                                            <!--</select>-->

                                        </div>

                                    </div>

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Total Height</span>

                                            

                                            <div class="range_wrap">

                                                <span class="rangeValue">18</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="30" min="18" max="60"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            

                                            <!--<select>-->

                                            <!--    <option>18</option>-->

                                            <!--    <option>19</option>-->

                                            <!--    <option>20</option>-->

                                            <!--    <option>21</option>-->

                                            <!--    <option>22</option>-->

                                            <!--    <option>23</option>-->

                                            <!--    <option>24</option>-->

                                            <!--    <option>25</option>-->

                                            <!--    <option>26</option>-->

                                            <!--    <option>27</option>-->

                                            <!--    <option>28</option>-->

                                            <!--    <option>29</option>-->

                                            <!--    <option selected>30</option>-->

                                            <!--    <option>31</option>-->

                                            <!--    <option>32</option>-->

                                            <!--    <option>33</option>-->

                                            <!--    <option>34</option>-->

                                            <!--    <option>35</option>-->

                                            <!--    <option>36</option>-->

                                            <!--    <option>37</option>-->

                                            <!--    <option>38</option>-->

                                            <!--    <option>39</option>-->

                                            <!--    <option>40</option>-->

                                            <!--    <option>41</option>-->

                                            <!--    <option>42</option>-->

                                            <!--    <option>43</option>-->

                                            <!--    <option>44</option>-->

                                            <!--    <option>45</option>-->

                                            <!--    <option>46</option>-->

                                            <!--    <option>47</option>-->

                                            <!--    <option>48</option>-->

                                            <!--    <option>49</option>-->

                                            <!--    <option>50</option>-->

                                            <!--    <option>51</option>-->

                                            <!--    <option>52</option>-->

                                            <!--    <option>53</option>-->

                                            <!--    <option>54</option>-->

                                            <!--    <option>55</option>-->

                                            <!--    <option>56</option>-->

                                            <!--    <option>57</option>-->

                                            <!--    <option>58</option>-->

                                            <!--    <option>59</option>-->

                                            <!--    <option>60</option>-->

                                            <!--</select>-->

                                        </div>

                                    </div>

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>Top Width</span>

                                            <div class="range_wrap">

                                                <span class="rangeValue">18</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="18" min="18" max="60"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            <!--<select>-->

                                            <!--    <option selected>18</option>-->

                                            <!--    <option>19</option>-->

                                            <!--    <option>20</option>-->

                                            <!--    <option>21</option>-->

                                            <!--    <option>22</option>-->

                                            <!--    <option>23</option>-->

                                            <!--    <option>24</option>-->

                                            <!--    <option>25</option>-->

                                            <!--    <option>26</option>-->

                                            <!--    <option>27</option>-->

                                            <!--    <option>28</option>-->

                                            <!--    <option>29</option>-->

                                            <!--    <option>30</option>-->

                                            <!--    <option>31</option>-->

                                            <!--    <option>32</option>-->

                                            <!--    <option>33</option>-->

                                            <!--    <option>34</option>-->

                                            <!--    <option>35</option>-->

                                            <!--    <option>36</option>-->

                                            <!--    <option>37</option>-->

                                            <!--    <option>38</option>-->

                                            <!--    <option>39</option>-->

                                            <!--    <option>40</option>-->

                                            <!--    <option>41</option>-->

                                            <!--    <option>42</option>-->

                                            <!--    <option>43</option>-->

                                            <!--    <option>44</option>-->

                                            <!--    <option>45</option>-->

                                            <!--    <option>46</option>-->

                                            <!--    <option>47</option>-->

                                            <!--    <option>48</option>-->

                                            <!--    <option>49</option>-->

                                            <!--    <option>50</option>-->

                                            <!--    <option>51</option>-->

                                            <!--    <option>52</option>-->

                                            <!--    <option>53</option>-->

                                            <!--    <option>54</option>-->

                                            <!--    <option>55</option>-->

                                            <!--    <option>56</option>-->

                                            <!--    <option>57</option>-->

                                            <!--    <option>58</option>-->

                                            <!--    <option>59</option>-->

                                            <!--    <option>60</option>-->

                                            <!--</select>-->

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!--<div class="accordion-item">-->

                        <!--    <h2 class="accordion-header" id="headingFive">-->

                        <!--        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">-->

                        <!--            Canopy Dimensions-->

                        <!--      </button>-->

                        <!--    </h2>-->

                        <!--    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">-->

                        <!--        <div class="accordion-body">-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>arc Height</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">23</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="23" min="0" max="23"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                                            <!--<select>-->

                                            <!--    <option>23</option>-->

                                            <!--</select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>canopy Depth</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">23</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="23" min="0" max="23"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                                            <!--<select>-->

                                            <!--    <option>23</option>-->

                                            <!--</select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>canopy Height </span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">26</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="26" min="0" max="26"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                                            <!--<select>-->

                                            <!--    <option>26</option>-->

                                            <!--</select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>canopy Width</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">34</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="34" min="0" max="34"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                                            <!--<select>-->

                                            <!--    <option>34</option>-->

                                            <!--</select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>straight Height</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">11.5</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="11.5" min="1" max="11.5"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->

                                            <!--<select>-->

                                            <!--    <option>1</option>-->

                                            <!--    <option>2</option>-->

                                            <!--    <option>3</option>-->

                                            <!--    <option>4</option>-->

                                            <!--    <option>5</option>-->

                                            <!--    <option>6</option>-->

                                            <!--    <option>7</option>-->

                                            <!--    <option>8</option>-->

                                            <!--    <option>9</option>-->

                                            <!--    <option>10</option>-->

                                            <!--    <option>11</option>-->

                                            <!--    <option selected>11.5</option>-->

                                            <!--</select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--        </div>-->

                        <!--    </div>-->

                        <!--</div>-->

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="headingSix">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">

                                    Lip Dimensions

                              </button>

                            </h2>

                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>lip Depth</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">24</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="24" min="0" max="24"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                            <!--<select>-->

                                            <!--    <option>24</option>-->

                                            <!--</select>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>lip Height</span>

                                            <div class="range_wrap">

                                                <span class="rangeValue"></span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="4" min="1" max="8"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            <!--<select>-->

                                            <!--    <option>1.5</option>-->

                                            <!--    <option>2</option>-->

                                            <!--    <option>3</option>-->

                                            <!--    <option selected>4</option>-->

                                            <!--    <option>5</option>-->

                                            <!--    <option>6</option>-->

                                            <!--    <option>7</option>-->

                                            <!--    <option>8</option>-->

                                            <!--</select>-->

                                        </div>

                                    </div>

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>lip Width</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">36</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="36" min="0" max="36"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                            <!--<select>-->

                                            <!--    <option>36</option>-->

                                            <!--</select>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    

                                </div>

                            </div>

                        </div>

                        <div class="accordion-item bands-item">

                            <h2 class="accordion-header" id="headingSeven">

                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">

                                    Bands

                              </button>

                            </h2>

                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>band Width </span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">1.5</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="1.5" min="0" max="1.5"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->


                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>band Thickness</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">0</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="0" min="0" max="1"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>horizontal Band Amt</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">2</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="2" min="0" max="2"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->


                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>horionztal Band Length</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">36</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="36.250" min="0" max="36.250"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--            <span>horizontal Band Depth</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">36</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="36.250" min="0" max="36.250"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>horizontal Band Spacing</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">0</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="3" min="0" max="3"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->


                                    <!--    </div>-->

                                    <!--</div>-->

                                    <div class="option-btn">

                                        <div class="model-opt">

                                            <span>vertical Band Amt</span>

                                            <div class="range_wrap">

                                                <span class="rangeValue">2</span>

                                                <div class="d-flex align-items-center">

                                                    <span>Min</span>

                                                   <Input class="range" type="range" value="2" min="0" max="4"></Input>

                                                    <span>Max</span>

                                                </div>

                                            </div>

                                            <!--<select>-->

                                            <!--    <option selected>2</option>-->

                                            <!--    <option>3</option>-->

                                            <!--    <option>4</option>-->

                                            <!--</select>-->

                                        </div>

                                    </div>

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>vertical Band Length</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">0</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="26" min="0" max="26"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->


                                    <!--    </div>-->

                                    <!--</div>-->

                                    <!--<div class="option-btn">-->

                                    <!--    <div class="model-opt">-->

                                    <!--        <span>vertical Band Spacing</span>-->

                                    <!--        <div class="range_wrap">-->

                                    <!--            <span class="rangeValue">0</span>-->

                                    <!--            <div class="d-flex align-items-center">-->

                                    <!--                <span>Min</span>-->

                                    <!--               <Input class="range" type="range" value="11" min="0" max="11"></Input>-->

                                    <!--                <span>Max</span>-->

                                    <!--            </div>-->

                                    <!--        </div>-->

                                        

                                    <!--    </div>-->

                                    <!--</div>-->

                                </div>

                            </div>

                        </div>

                        <!--<div class="accordion-item">-->

                        <!--    <h2 class="accordion-header" id="headingEight">-->

                        <!--        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">-->

                        <!--            Rivets-->

                        <!--      </button>-->

                        <!--    </h2>-->

                        <!--    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">-->

                        <!--        <div class="accordion-body">-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>horionztal Rivet Amt</span>-->

                        <!--                    <select>-->

                        <!--                        <option></option>-->

                        <!--                    </select>-->

                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>rivet Diameter</span>-->

                                            

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">0</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="0.428" min="0" max="1"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->


                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>rivet Dist From Edge</span>-->

                                            

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">0</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value=".75" min="0" max="1"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->


                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>rivet Spacing</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">0</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="0" min="0" max="4"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->


                        <!--                </div>-->

                        <!--            </div>-->

                        <!--            <div class="option-btn">-->

                        <!--                <div class="model-opt">-->

                        <!--                    <span>vertical Rivet Amt</span>-->

                        <!--                    <div class="range_wrap">-->

                        <!--                        <span class="rangeValue">0</span>-->

                        <!--                        <div class="d-flex align-items-center">-->

                        <!--                            <span>Min</span>-->

                        <!--                           <Input class="range" type="range" value="7" min="0" max="7"></Input>-->

                        <!--                            <span>Max</span>-->

                        <!--                        </div>-->

                        <!--                    </div>-->


                        <!--                </div>-->

                        <!--            </div>-->

                                    

                        <!--        </div>-->

                        <!--    </div>-->

                        <!--</div>-->

                    </div>

                </div>

                <div class="col-md-9">

                    <div class="model-viewer">

                        <img src="https://demo-customlinks.com/modernaire/public/images/models/model1.jpg" alt="">

                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trm3.png" alt="">

                    </div>

                </div>

                <div class="sidebar-wrpap">

                    <div class="selcted-design-box">

                        <img src="https://demo-customlinks.com/modernaire/public/images/models/model.jpg" alt="">

                        <h6>Model</h6>

                        <h4>Chateau Hood</h4>

                    </div>

                    <div class="selcted-design-box color-tag">

                        <div class="color-slect"></div>

                        <h6>Color</h6>

                        <h4>Lafayette Blue</h4>

                    </div>

                    <div class="selcted-design-box trim-tag">

                        <img src="https://demo-customlinks.com/modernaire/public/images/models/trim1.jpg" alt="">

                        <h6>Model</h6>

                        <h4>Chateau Hood</h4>

                    </div>

                </div>

            </div>

        </div>

    </div>





    

    







<!-- ============================================================== -->

<!-- BODY END HERE -->

<!-- ============================================================== -->



@endsection

@section('css')

<style>

/* Build */



.selcted-design-box>img {

    width: 180px;

    object-fit: contain;

    border: 1px solid #d4d4d4;

}



.selcted-design-box {

    text-align: center;

    margin: 0;

    border-bottom: 1px solid #b8b8b8;

    padding: 30px 0;

}



.selcted-design-box>h6 {

    margin: 10px 0 0;

    font-weight: 600;

    text-transform: uppercase;

    color: #808080;

}



.selcted-design-box>h4 {

    font-size: 20px;

    color: #000;

    margin: 10px 0 0;

    line-height: 1;

}

header#header {

    background: #000;

}

.Builder-wrapper {

    margin: 150px 0 0;

    position:relative;

}

.accordion-header {

    line-height: 1.5;

}

.sidebar-wrpap {

    background: #eee;

    height: 100vh;

    position: absolute;

    width: 320px;

    right: 0;

    display: grid;

    align-content: center;

    padding-bottom: 50px;

    top: 0;

}



.color-slect {

    height: 80px;

    width: 90px;

    margin: auto;

    background: #002b55;

}



.model-viewer>img:last-child {

    position: absolute;

    left: 0;

    top: 0;

    right: 0;

    margin: auto;

}



.model-viewer {

    position: relative;

    text-align: center;

}



.model-viewer>img {

    width: 100%;

}



.selcted-design-box:last-child {

    border: 0;

}



.side-model-selector {

    position: absolute;

    width: 300px;

    left: 0;

    top: 0;

    height: 100vh;

    background: #eee;

    padding: 0;

    border-right: 2px solid #a5a5a5;

}



.accordion-button {

    font-size: 20px;

    font-weight: 600;

    color: #666;

    padding: 10px;

}



.accordion-button:not(.collapsed) {

    color: #000;

    background: #e5e5e5;

    box-shadow: none;

}



.accordion-button:not(.collapsed)::after {

    filter: grayscale(1);

}



.nav-tabs {

    white-space: nowrap;

    display: block;

    overflow: auto;

}



.nav-tabs>li {

    display: inline-block;

    border: 0 !important;

}



.nav-tabs>li>a {

    border: 0 !important;

    color: #666 !important;

    font-size: 16px;

}



.accordion-body {

    padding: 0 5px;

}



.nav-tabs .nav-link.active,

.nav-tabs .nav-item.show .nav-link {

    color: #000 !important;

    font-weight: 600;

}





/* width */



.nav-tabs::-webkit-scrollbar {

    width: 5px;

    height: 4px;

}





/* Track */



.nav-tabs::-webkit-scrollbar-track {

    background: #f1f1f1;

}





/* Handle */



.nav-tabs::-webkit-scrollbar-thumb {

    background: #c9c9c9;

    border-radius: 50px;

}





/* Handle on hover */



.nav-tabs::-webkit-scrollbar-thumb:hover {

    background: #555;

}



.accordion-button:focus {

    box-shadow: none !important;

}



.color-opt {

    height: 80px;

    width: 80px;

    text-align: center;

    display: grid;

    align-content: end;

    font-size: 13px;

    line-height: 1.2;

    padding: 0 7px;

    padding-bottom: 10px;

    position: relative;

}



.selectr-grid {

    display: flex;

    align-items: center;

    justify-content: start;

    flex-flow: wrap;

    padding: 10px 0;

}



.option-btn {

    margin: 5px;

    cursor: pointer;

}



.color-opt>i {

    position: absolute;

    font-size: 50px;

    opacity: 0.3;

    height: 100%;

    width: 100%;

    left: 0;

    right: 0;

    margin: auto;

    top: 8px;

    display: none;

}



.color-opt.active>i {

    display: block;

}



.trim-opt {

    display: flex;

    align-items: center;

    border-top: 1px solid #e5e5e5;

    padding-top: 10px;

    position: relative;

}



.trim-opt>img {

    width: 30%;

    margin-right: 10px;

}



.trim-opt>span {

    font-size: 15px;

    line-height: 1.2;

    padding-right: 20px;

}



.trim-opt>i {

    color: #3cb23c;

    opacity: 0;

    position: absolute;

    right: 0;

}



.trim-opt.active>i {

    opacity: 1;

}



.model-opt {

    position: relative;

    font-size: 20px;

    padding: 6px 0;

    display: flex;

    align-items: center;

    justify-content: space-between;

}



.model-opt span {

    font-size: 15px;

    text-transform: capitalize;

}



.model-opt>i {

    color: #3cb23c;

}



.option-btn select {

    width: 30%;

    padding: 5px 5px;

    background-position: 61px 15px;

    font-size: 15px;

    background-size: 10px;

}



/*.bands-item .accordion-body {*/

/*    height: 270px;*/

/*    overflow-y: scroll;*/

/*}*/





.range_wrap {

  /* position: absolute; */

}

#rangeValue {

  position: relative;

  display: block;

  text-align: center;

  font-size: 18px;

  color: #999;

  font-weight: 400;

}

.range {

  width: 140px;

  height: 15px;

  -webkit-appearance: none;

  background: #f9c424;

  outline: none;

  border-radius: 15px;

  overflow: hidden;

  /* box-shadow: inset 0 0 5px rgba(0, 0, 0, 1); */

}

.range::-webkit-slider-thumb {

  -webkit-appearance: none;

  width: 15px;

  height: 15px;

  border-radius: 50%;

  /* background: #f9c424; */
  background: #111111;

  cursor: pointer;

  border: 4px solid #333;

  box-shadow: -407px 0 0 400px #111111;

}



.range_wrap .d-flex.align-items-center span {

    margin: 0 4px;

    width: 30%;

}

.rangeValue {

    width: 100%;

    text-align: center;

    display: block;

}











</style>

@endsection



@section('js')

<script>

$('.color-opt').click(function() {

    $(this).parent().parent().find('.color-opt').removeClass('active');

    $(this).addClass('active');

    $('.model-viewer>img').eq(0).attr('src', $(this).attr('data-img-src'));

    $('.color-tag .color-slect').css('background-color', $(this).css('background-color'));

    $('.color-tag h4').text($(this).find('span').text());

})



$('.trim-opt').click(function() {

    $(this).parent().parent().find('.trim-opt').removeClass('active');

    $(this).addClass('active');

    $('.model-viewer>img').eq(1).attr('src', $(this).attr('data-img-src'));

    $('.trim-tag>img').attr('src', $(this).find('img').attr('src'));

    $('.trim-tag h4').text($(this).find('span').text());

})

</script>









<script>



$(".range").change(function() {

    $(this).parent().prev().text($(this).val());

    

    })

    $(".range").mousemove(function(rngeval) {

        $(this).parent().prev().text($(this).val());

        

    })

   

</script>







<script>

// var RGBChange = function() {

// 	$("#val").val(g.getValue());

// };



// var g = $('#G').slider()

// 		.on('slide', RGBChange)

// 		.data('slider');

</script>



@endsection