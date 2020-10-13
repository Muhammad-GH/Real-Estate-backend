import React, { Component } from "react";
import axios from "axios";
import { Redirect } from "react-router-dom";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import File from "../../images/file-icon.png";
import { Helper, url } from "../../helper/helper";
import Alert from "react-bootstrap/Alert";
import Spinner from "react-bootstrap/Spinner";
import ProgressBar from "react-bootstrap/ProgressBar";
import Datetime from "react-datetime";
import moment from "moment";
import { withTranslation } from "react-i18next";

class Createworklist extends Component {
  fileObj = [];
  fileArray = [];
  files = [];

  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.state = {
      title: "",
      title_err: false,
      categoryId: "",
      categoryId_err: false,
      productcat: [],
      cities: [],
      states: [],
      budget: "",
      budget_err: false,
      rate: "",
      rate_err: false,
      available_from: "",
      available_to: "",
      available_from_err: false,
      available_to_err: false,
      city: "",
      city_err: false,
      pincode: "",
      pincode_err: false,
      post_expiry_date: "",
      post_expiry_date_err: false,
      description: "",
      description_err: false,
      featured_image: null,
      attachment: null,
      slider_image: [],
      featured_image_err: false,
      attachment_err: false,
      slider_image_err: false,
      checked: false,
      mat_checked: 0,
      attachment_preview: null,
      slider_image_preview: [null],
      errors: [],
      show_errors: false,
      show_msg: false,
      loading: false,
      loaded: 0,
      loaded1: 0,
      loaded2: 0,
      configs: [],
      datepicker_date_format: "",
      datepicker_time_format: "",
    };
    this.myRef = React.createRef();
  }

  componentDidMount = () => {
    this.loadCategory();
    this.loadState();
    this.loadConfig();
  };

  loadState = async () => {
    const token = await localStorage.getItem("token");
    let lang = await localStorage.getItem("i18nextLng");
    axios
      .get(`${url}/api/state/${lang}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ states: result.data.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  loadConfig = async () => {
    const token = await localStorage.getItem("token");
    await axios
      .get(`${url}/api/config`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ configs: result.data.data });
        this.state.configs.map((config) => {
          if (config.configuration_name == "datepicker_date_format") {
            this.setState({ datepicker_date_format: config.configuration_val });
          }
          if (config.configuration_name == "datepicker_time_format") {
            this.setState({ datepicker_time_format: config.configuration_val });
          }
        });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  loadCategory = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/category`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        console.log(result.data.data);
        this.setState({ productcat: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  loadCities = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/city`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        console.log(result.data.data);
        this.setState({ cities: result.data.data });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  removeImg = (event) => {
    event.preventDefault();
    this.fileArray = [];
    this.setState({ slider_image: [], loaded2: 0 });
  };

  handleChange1 = (event) => {
    this.setState({ title: event.target.value });
  };
  handleChange2 = (event) => {
    this.setState({ categoryId: event.target.value });
  };
  handleChange3 = (event) => {
    this.setState({ budget: event.target.value });
  };
  handleChange4 = (event) => {
    this.setState({ rate: event.target.value });
  };
  handleChange5 = (event) => {
    this.setState({ available_from: moment(event._d).format("YYYY-MM-DD") });
  };
  handleChange6 = (event) => {
    this.setState({ available_to: moment(event._d).format("YYYY-MM-DD") });
  };
  handleChange7 = (event) => {
    this.setState({ city: event.target.value });
  };
  ChangeCity = (event) => {
    this.setState({ cities: [] });
    const token = localStorage.getItem("token");
    let lang = localStorage.getItem("i18nextLng");
    axios
      .get(`${url}/api/cityId/${event.target.value}/${lang}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ cities: result.data.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };
  handleChange8 = (event) => {
    this.setState({ pincode: event.target.value });
  };
  handleChange9 = (event) => {
    this.setState({ post_expiry_date: event._d });
  };
  handleChange10 = (event) => {
    this.setState({ description: event.target.value });
  };
  handleChange11 = (event) => {
    this.setState({ featured_image: null });
    if (
      event.target.files[0].name.split(".").pop() == "jpeg" ||
      event.target.files[0].name.split(".").pop() == "png" ||
      event.target.files[0].name.split(".").pop() == "jpg" ||
      event.target.files[0].name.split(".").pop() == "gif" ||
      event.target.files[0].name.split(".").pop() == "svg"
    ) {
      this.setState({
        featured_image: event.target.files[0],
        loaded: 50,
        featured_image_err: false,
        attachment_preview: URL.createObjectURL(event.target.files[0]),
      });
      if (this.state.loaded <= 100) {
        setTimeout(
          function () {
            this.setState({ loaded: 100 });
          }.bind(this),
          2000
        ); // wait 2 seconds, then reset to false
      }
    } else {
      this.setState({ featured_image_err: true, featured_image: null });
      alert("File type not supported");
    }
  };
  handleChange12 = (event) => {
    if (event.target.files[0].size > 2097152) {
      return alert("cannot be more than 2 mb");
    }
    if (
      event.target.files[0].name.split(".").pop() == "pdf" ||
      event.target.files[0].name.split(".").pop() == "docx" ||
      event.target.files[0].name.split(".").pop() == "doc"
    ) {
      this.setState({
        attachment: event.target.files[0],
        loaded1: 50,
        attachment_err: false,
      });
      if (this.state.loaded1 <= 100) {
        setTimeout(
          function () {
            this.setState({ loaded1: 100 });
          }.bind(this),
          2000
        ); // wait 2 seconds, then reset to false
      }
    } else {
      this.setState({ attachment_err: true, attachment: null });
      return alert("File type not supported");
    }
  };
  handleChange13 = (event) => {
    this.files = [];
    Array.from(event.target.files).forEach((file) => {
      if (
        file.name.split(".").pop() == "jpeg" ||
        file.name.split(".").pop() == "png" ||
        file.name.split(".").pop() == "jpg" ||
        file.name.split(".").pop() == "gif" ||
        file.name.split(".").pop() == "svg"
      ) {
        this.files.push(file);
      }
    });
    this.fileObj = [];
    this.fileArray = [];
    this.fileObj.push(this.files);
    for (let i = 0; i < this.fileObj[0].length; i++) {
      this.fileArray.push(URL.createObjectURL(this.fileObj[0][i]));
    }
    this.setState({
      slider_image: this.files,
      loaded2: 50,
      slider_image_err: false,
      slider_image_preview: this.fileArray,
    });
    if (this.state.loaded2 <= 100) {
      setTimeout(
        function () {
          this.setState({ loaded2: 100 });
        }.bind(this),
        2000
      ); // wait 2 seconds, then reset to false
    }
  };

  handleCheck = (event) => {
    this.setState({ checked: !this.state.checked }, () => {
      if (this.state.checked) {
        this.setState({ mat_checked: 1 });
      }
    });
  };

  // work request
  handleSubmit = async (event) => {
    event.preventDefault();
    this.setState({
      title_err: false,
      categoryId_err: false,
      pincode_err: false,
      post_expiry_date_err: false,
      description_err: false,
      budget_err: false,
      rate_err: false,
      city_err: false,
      featured_image_err: false,
      attachment_err: false,
      slider_image_err: false,
      available_from_err: false,
      available_to_err: false,
      delivery_cost_err: false,
      warranty_err: false,
    });
    if (this.state.title.length <= 0) {
      this.setState({ title_err: true });
    }
    if (this.state.categoryId == "--Select--" || this.state.categoryId == "") {
      this.setState({ categoryId_err: true });
    }
    if (this.state.pincode.length <= 0) {
      this.setState({ pincode_err: true });
    }
    if (
      this.state.post_expiry_date == "" ||
      this.state.post_expiry_date == undefined
    ) {
      this.setState({ post_expiry_date_err: true });
    }
    if (this.state.description.length <= 0) {
      this.setState({ description_err: true });
    }
    if (this.state.rate.length <= 0) {
      this.setState({ rate_err: true });
    }
    if (this.state.available_from.length <= 0) {
      this.setState({ available_from_err: true });
    }
    if (this.state.available_to.length <= 0) {
      this.setState({ available_to_err: true });
    }
    if (this.state.budget == "--Select--" || this.state.budget == "") {
      this.setState({ budget_err: true });
    }
    if (this.state.city == "--Select--" || this.state.city == "") {
      this.setState({ city_err: true });
    }
    if (this.state.featured_image == null) {
      this.setState({ featured_image_err: true });
    }
    if (this.state.attachment == null) {
      this.setState({ attachment_err: true });
    }
    if (this.state.slider_image.length <= 0) {
      this.setState({ slider_image_err: true });
    }

    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("title", this.state.title);
    data.set("categoryId", this.state.categoryId);
    data.set("budget", this.state.budget);
    data.set("rate", this.state.rate);
    data.set("available_from", this.state.available_from);
    data.set("available_to", this.state.available_to);
    data.set("city", this.state.city);
    data.set("pincode", this.state.pincode);
    data.set("extra", this.state.mat_checked);
    data.set("post_expiry_date", this.state.post_expiry_date);
    data.set("description", this.state.description);
    data.append("featured_image", this.state.featured_image);
    data.append("attachment", this.state.attachment);
    for (const key of Object.keys(this.state.slider_image)) {
      data.append("slider_image[]", this.state.slider_image[key]);
    }

    axios
      .post(`${url}/api/work-request/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        console.log(res);
        this.setState({ show_msg: true, loading: false });
        this.myRef.current.scrollTo(0, 0);
      })
      .catch((err) => {
        Object.entries(err.response.data.error).map(([key, value]) => {
          this.setState({ errors: err.response.data.error });
        });
        this.setState({ show_errors: true, loading: false });
        this.myRef.current.scrollTo(0, 0);
      });

    // Display the key/value pairs
    // for (var pair of data.entries()) {
    //   console.log(pair[0] + ", " + pair[1]);
    // }
  };

  // work offer
  handleSubmit1 = async (event) => {
    event.preventDefault();
    this.setState({
      title_err: false,
      categoryId_err: false,
      pincode_err: false,
      post_expiry_date_err: false,
      description_err: false,
      budget_err: false,
      rate_err: false,
      city_err: false,
      featured_image_err: false,
      attachment_err: false,
      slider_image_err: false,
      available_from_err: false,
      available_to_err: false,
      delivery_cost_err: false,
      warranty_err: false,
    });
    if (this.state.title.length <= 0) {
      this.setState({ title_err: true });
    }
    if (this.state.categoryId == "--Select--" || this.state.categoryId == "") {
      this.setState({ categoryId_err: true });
    }
    if (this.state.pincode.length <= 0) {
      this.setState({ pincode_err: true });
    }
    if (
      this.state.post_expiry_date == "" ||
      this.state.post_expiry_date == undefined
    ) {
      this.setState({ post_expiry_date_err: true });
    }
    if (this.state.description.length <= 0) {
      this.setState({ description_err: true });
    }
    if (this.state.rate.length <= 0) {
      this.setState({ rate_err: true });
    }
    if (this.state.available_from.length <= 0) {
      this.setState({ available_from_err: true });
    }
    if (this.state.available_to.length <= 0) {
      this.setState({ available_to_err: true });
    }
    if (this.state.budget == "--Select--" || this.state.budget == "") {
      this.setState({ budget_err: true });
    }
    if (this.state.city == "--Select--" || this.state.city == "") {
      this.setState({ city_err: true });
    }
    if (this.state.featured_image == null) {
      this.setState({ featured_image_err: true });
    }
    if (this.state.attachment == null) {
      this.setState({ attachment_err: true });
    }
    if (this.state.slider_image.length <= 0) {
      this.setState({ slider_image_err: true });
    }

    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("title", this.state.title);
    data.set("categoryId", this.state.categoryId);
    data.set("budget", this.state.budget);
    data.set("rate", this.state.rate);
    data.set("available_from", this.state.available_from);
    data.set("available_to", this.state.available_to);
    data.set("city", this.state.city);
    data.set("pincode", this.state.pincode);
    data.set("extra", this.state.mat_checked);
    data.set("post_expiry_date", this.state.post_expiry_date);
    data.set("description", this.state.description);
    data.append("featured_image", this.state.featured_image);
    data.append("attachment", this.state.attachment);
    for (const key of Object.keys(this.state.slider_image)) {
      data.append("slider_image[]", this.state.slider_image[key]);
    }

    axios
      .post(`${url}/api/work-offers/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
        console.log(res);
        this.setState({ show_msg: true, loading: false });
        this.myRef.current.scrollTo(0, 0);
      })
      .catch((err) => {
        console.log(err.response.data);
        Object.entries(err.response.data.error).map(([key, value]) => {
          this.setState({ errors: err.response.data.error });
        });
        this.setState({ show_errors: true, loading: false });
        this.myRef.current.scrollTo(0, 0);
      });
  };

  render() {
    const { t, i18n } = this.props;

    let alert, loading;
    if (this.state.show_errors === true) {
      alert = (
        <Alert variant="danger" style={{ fontSize: "13px", zIndex: 1 }}>
          {Object.entries(this.state.errors).map(([key, value]) => {
            const stringData = value.reduce((result, item) => {
              return `${item} `;
            }, "");
            return stringData;
          })}
        </Alert>
      );
    }
    if (this.state.show_msg === true) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          {t("success.work_ins")}
        </Alert>
      );
    }
    if (this.state.loading === true) {
      loading = (
        <Spinner animation="border" role="status">
          <span className="sr-only">Loading...</span>
        </Spinner>
      );
    }

    return (
      <div>
        <Header active={"market"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item active" aria-current="page">
              {t("header.marketplace")}
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              {t("c_work_list.title")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div ref={this.myRef} className="page-content">
            {alert ? alert : null}
            <div className="container-fluid">
              <h3 className="head3">{t("c_work_list.title")}</h3>
              <div className="card">
                <div className="card-body">
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label>{t("c_material_list.request.type_list")}</label>
                        <small
                          class="form-text text-muted"
                          style={{ fontSize: "15px" }}
                        >
                          {t("c_material_list.request.sub_title")}
                        </small>
                        <ul
                          class="nav tablist"
                          id="listing-type"
                          role="tablist"
                        >
                          <li class="nav-item" role="presentation">
                            <a
                              class="nav-link active"
                              id="type-request-tab"
                              data-toggle="pill"
                              href="#type-request"
                              role="tab"
                              aria-controls="type-request"
                              aria-selected="true"
                            >
                              {t("feeds.search.request")}
                            </a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a
                              class="nav-link"
                              id="type-offer-tab"
                              data-toggle="pill"
                              href="#type-offer"
                              role="tab"
                              aria-controls="type-offer"
                              aria-selected="false"
                            >
                              {t("feeds.search.offer")}
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div
                    class="tab-content"
                    id="type-tabContent"
                    style={{ maxWidth: "960px" }}
                  >
                    <div
                      class="tab-pane fade show active"
                      id="type-request"
                      role="tabpanel"
                      aria-labelledby="type-request"
                    >
                      <form>
                        <div class="row gutters-40">
                          <div class="col-md-5 col-lg-4">
                            <div class="form-group">
                              <label for="title">
                                {t("c_material_list.request.input_title")}
                              </label>
                              <input
                                id="title"
                                style={
                                  this.state.title_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onChange={this.handleChange1}
                                name="title"
                                type="text"
                                class="form-control"
                                placeholder=""
                              />
                            </div>
                            <div class="form-group">
                              <label for="categoryId">
                                {t("c_material_list.request.category")}
                              </label>
                              <select
                                style={
                                  this.state.categoryId_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onClick={this.handleChange2}
                                name="categoryId"
                                id="categoryId"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.productcat.map(
                                  ({ category_id, category_name }, index) => (
                                    <option value={category_id}>
                                      {category_name}
                                    </option>
                                  )
                                )}
                              </select>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-8">
                                <div class="form-group">
                                  <label for="budget">
                                    {t("c_work_list.budget")}
                                  </label>
                                  <select
                                    style={
                                      this.state.budget_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onClick={this.handleChange3}
                                    name="budget"
                                    id="budget"
                                    class="form-control"
                                  >
                                    <option>--Select--</option>
                                    <option value="Fixed">Fixed</option>
                                    <option value="Hourly">Hourly</option>
                                    <option value="per_m2">cost/m2</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label for="rate">
                                    {t("c_work_list.rate")}
                                  </label>
                                  <input
                                    id="rate"
                                    style={
                                      this.state.rate_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onChange={this.handleChange4}
                                    name="rate"
                                    type="text"
                                    class="form-control"
                                    placeholder="100"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-6">
                                <div class="form-group">
                                  <label for="available_from">
                                    {t("c_work_list.work_start")}
                                  </label>
                                  <div
                                    style={
                                      this.state.available_from_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <Datetime
                                      onChange={(date) =>
                                        this.handleChange5(date)
                                      }
                                      name="available_from"
                                      dateFormat="DD-MM-YYYY"
                                      timeFormat={false}
                                    />
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group">
                                  <label for="available_to">
                                    {t("c_work_list.work_end")}
                                  </label>
                                  <div
                                    style={
                                      this.state.available_to_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <Datetime
                                      onChange={(date) =>
                                        this.handleChange6(date)
                                      }
                                      name="available_from"
                                      dateFormat="DD-MM-YYYY"
                                      timeFormat={false}
                                    />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="state">
                                {t("feeds.search.state")}
                              </label>
                              <select
                                onChange={this.ChangeCity}
                                style={
                                  this.state.city_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                name="state"
                                id="state"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.states.map(
                                  ({ state_id, state_identifier }, index) => {
                                    if (state_id !== undefined) {
                                      return (
                                        <option value={state_id}>
                                          {state_identifier}
                                        </option>
                                      );
                                    }
                                  }
                                )}
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="city">
                                {t("c_material_list.request.city")}
                              </label>
                              <select
                                onClick={this.handleChange7}
                                style={
                                  this.state.city_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                name="city"
                                id="city"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.cities.map(
                                  ({ city_id, city_identifier }, index) => {
                                    if (city_id !== undefined) {
                                      return (
                                        <option value={city_id}>
                                          {city_identifier}
                                        </option>
                                      );
                                    }
                                  }
                                )}
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="pincode">
                                {t("c_material_list.request.pincode")}
                              </label>
                              <input
                                style={
                                  this.state.pincode_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                id="pincode"
                                onChange={this.handleChange8}
                                name="pincode"
                                type="text"
                                class="form-control"
                                placeholder="140603"
                              />
                            </div>
                            <div class="form-group">
                              <label for="post_expiry_date">
                                {t("c_material_list.request.post_expires_in")}
                              </label>
                              <div
                                style={
                                  this.state.post_expiry_date_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                              >
                                <Datetime
                                  onChange={(date) => this.handleChange9(date)}
                                  name="post_expiry_date"
                                  dateFormat={this.state.datepicker_date_format}
                                  timeFormat={this.state.datepicker_time_format}
                                />
                              </div>
                            </div>

                            <div className="form-group">
                              <div className="form-check form-check-inline">
                                <input
                                  type="checkbox"
                                  className="form-check-input"
                                  id="material1"
                                  onChange={this.handleCheck}
                                />
                                <label
                                  className="form-check-label"
                                  htmlFor="material1"
                                >
                                  {t("feeds.search.material")}
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7 col-lg-8">
                            <div class="form-group">
                              <label for="Desc">
                                {t("c_material_list.request.description")}
                              </label>
                              <textarea
                                onChange={this.handleChange10}
                                style={
                                  this.state.description_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                name="description"
                                id="Desc"
                                class="form-control"
                              ></textarea>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-xl-5 col-sm-6">
                                <div class="form-group">
                                  <label for="main">
                                    {t("c_material_list.request.main")}
                                  </label>
                                  <div
                                    class="file-select"
                                    style={
                                      this.state.featured_image_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <input
                                      onChange={this.handleChange11}
                                      name="featured_image"
                                      type="file"
                                      id="main"
                                    />
                                    <label for="main">
                                      <img
                                        src={
                                          this.state.attachment_preview
                                            ? this.state.attachment_preview
                                            : File
                                        }
                                        alt=""
                                      />
                                      <span class="status">Upload status</span>
                                      <ProgressBar now={this.state.loaded} />
                                    </label>
                                    <small class="form-text text-muted">
                                      jpeg, png, jpg, gif, svg
                                    </small>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-5 col-sm-6">
                                <div
                                  class="form-group"
                                  style={
                                    this.state.attachment_err === true
                                      ? { border: "1px solid #eb516d" }
                                      : {}
                                  }
                                >
                                  <label for="attachment">
                                    {t("c_material_list.request.attachment")}
                                  </label>
                                  <div class="file-select">
                                    <input
                                      onChange={this.handleChange12}
                                      name="attachment"
                                      type="file"
                                      id="attachment"
                                    />
                                    <label for="attachment">
                                      <img src={File} alt="" />
                                      <span class="status">Upload status</span>
                                      <ProgressBar now={this.state.loaded1} />
                                    </label>
                                    <small class="form-text text-muted">
                                      {t(
                                        "c_material_list.request.attachment_text"
                                      )}
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>
                                {t("c_material_list.request.product_images")}
                              </label>
                              <div class="row">
                                <div class="col-xl-10">
                                  <div class="row gutters-14">
                                    <div class="col-lg-3 col-sm-4 col-6">
                                      <div
                                        class="file-select"
                                        style={
                                          this.state.slider_image_err === true
                                            ? { border: "1px solid #eb516d" }
                                            : {}
                                        }
                                      >
                                        <input
                                          onChange={this.handleChange13}
                                          multiple
                                          name="slider_image[]"
                                          type="file"
                                          id="file1"
                                        />
                                        <label for="file1">
                                          {this.fileArray.length <= 0 ? (
                                            <img src={File} alt="..." />
                                          ) : (
                                            this.fileArray.map((url) => (
                                              <div>
                                                <img
                                                  style={{ height: "100px" }}
                                                  src={
                                                    this.fileArray.length <= 0
                                                      ? File
                                                      : url
                                                  }
                                                  alt="..."
                                                />
                                              </div>
                                            ))
                                          )}
                                          <span class="status">Upload</span>
                                          <ProgressBar
                                            now={this.state.loaded2}
                                          />
                                        </label>
                                        <small class="form-text text-muted">
                                          jpeg, png, jpg, gif, svg
                                        </small>
                                        {this.state.slider_image == "" ? (
                                          ""
                                        ) : (
                                          <button
                                            style={{ marginTop: "10px" }}
                                            onClick={this.removeImg}
                                            class="btn btn-danger"
                                          >
                                            Remove
                                          </button>
                                        )}
                                        <small
                                          class="form-text text-muted"
                                          style={{
                                            fontSize: "13px",
                                            marginTop: "10px",
                                          }}
                                        >
                                          {t(
                                            "c_material_list.request.product_images_text"
                                          )}
                                        </small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                              <label class="d-none d-xl-block">&nbsp;</label>
                              <div class="clear"></div>
                              {loading ? (
                                loading
                              ) : (
                                <button
                                  onClick={this.handleSubmit}
                                  class="btn btn-success"
                                >
                                  Submit
                                </button>
                              )}
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div
                      class="tab-pane fade"
                      id="type-offer"
                      role="tabpanel"
                      aria-labelledby="type-offer"
                    >
                      <form>
                        <div class="row gutters-40">
                          <div class="col-md-5 col-lg-4">
                            <div class="form-group">
                              <label for="title1">
                                {t("c_material_list.request.input_title")}
                              </label>
                              <input
                                id="title1"
                                style={
                                  this.state.title_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onChange={this.handleChange1}
                                name="title"
                                type="text"
                                class="form-control"
                                placeholder=""
                              />
                            </div>
                            <div class="form-group">
                              <label for="category1">
                                {t("c_material_list.request.category")}
                              </label>
                              <select
                                style={
                                  this.state.categoryId_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onClick={this.handleChange2}
                                name="categoryId"
                                id="category1"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.productcat.map(
                                  ({ category_id, category_name }, index) => (
                                    <option value={category_id}>
                                      {category_name}
                                    </option>
                                  )
                                )}
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="budget1">
                                {t("c_work_list.budget")}
                              </label>
                              <select
                                style={
                                  this.state.budget_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onClick={this.handleChange3}
                                name="budget"
                                id="budget1"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                <option value="Fixed">Fixed</option>
                                <option value="Hourly">Hourly</option>
                                <option value="per_m2">cost/m2</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="availablity">
                                {t("c_work_list.availablity")}
                              </label>
                              <div class="row gutters-24">
                                <div class="col-6">
                                  <div
                                    style={
                                      this.state.available_from_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <Datetime
                                      onChange={(date) =>
                                        this.handleChange5(date)
                                      }
                                      name="available_from"
                                      dateFormat="DD-MM-YYYY"
                                      timeFormat={false}
                                    />
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div
                                    style={
                                      this.state.available_to_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <Datetime
                                      onChange={(date) =>
                                        this.handleChange6(date)
                                      }
                                      name="available_to"
                                      dateFormat="DD-MM-YYYY"
                                      timeFormat={false}
                                    />
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="state">
                                {t("feeds.search.state")}
                              </label>
                              <select
                                onChange={this.ChangeCity}
                                style={
                                  this.state.city_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                name="state"
                                id="state"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.states.map(
                                  ({ state_id, state_identifier }, index) => {
                                    if (state_id !== undefined) {
                                      return (
                                        <option value={state_id}>
                                          {state_identifier}
                                        </option>
                                      );
                                    }
                                  }
                                )}
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="city">
                                {t("c_material_list.request.city")}
                              </label>
                              <select
                                onClick={this.handleChange7}
                                style={
                                  this.state.city_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                name="city"
                                id="city"
                                class="form-control"
                              >
                                <option>--Select--</option>
                                {this.state.cities.map(
                                  ({ city_id, city_identifier }, index) => {
                                    if (city_id !== undefined) {
                                      return (
                                        <option value={city_id}>
                                          {city_identifier}
                                        </option>
                                      );
                                    }
                                  }
                                )}
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="pincode1">
                                {t("c_material_list.request.pincode")}
                              </label>
                              <input
                                style={
                                  this.state.pincode_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onChange={this.handleChange8}
                                name="pincode"
                                id="pincode1"
                                type="text"
                                class="form-control"
                                placeholder="140603"
                              />
                            </div>
                            <div class="form-group">
                              <label for="post_expiry_date">
                                {t("c_material_list.request.post_expires_in")}
                              </label>
                              <div
                                style={
                                  this.state.post_expiry_date_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                              >
                                <Datetime
                                  onChange={(date) => this.handleChange9(date)}
                                  name="post_expiry_date"
                                  dateFormat={this.state.datepicker_date_format}
                                  timeFormat={this.state.datepicker_time_format}
                                />
                              </div>
                            </div>

                            <div className="form-group">
                              <div className="form-check form-check-inline">
                                <input
                                  type="checkbox"
                                  className="form-check-input"
                                  id="material2"
                                  onChange={this.handleCheck}
                                />
                                <label
                                  className="form-check-label"
                                  htmlFor="material2"
                                >
                                  {t("feeds.search.material")}
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-7 col-lg-8">
                            <div class="form-group">
                              <label for="Desc1">
                                {t("c_material_list.request.description")}
                              </label>
                              <textarea
                                style={
                                  this.state.description_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onChange={this.handleChange10}
                                name="description"
                                id="Desc1"
                                class="form-control"
                              ></textarea>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-xl-5 col-sm-6">
                                <div class="form-group">
                                  <label for="main1">
                                    {t("c_material_list.request.main")}
                                  </label>
                                  <div
                                    class="file-select"
                                    style={
                                      this.state.featured_image_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <input
                                      onChange={this.handleChange11}
                                      name="featured_image"
                                      type="file"
                                      id="main1"
                                    />
                                    <label for="main1">
                                      <img
                                        src={
                                          this.state.attachment_preview
                                            ? this.state.attachment_preview
                                            : File
                                        }
                                        alt=""
                                      />
                                      <span class="status">Upload status</span>
                                      <ProgressBar now={this.state.loaded} />
                                    </label>
                                    <small class="form-text text-muted">
                                      jpeg, png, jpg, gif, svg
                                    </small>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl-5 col-sm-6">
                                <div
                                  class="form-group"
                                  style={
                                    this.state.attachment_err === true
                                      ? { border: "1px solid #eb516d" }
                                      : {}
                                  }
                                >
                                  <label for="attachment1">
                                    {t("c_material_list.request.attachment")}
                                  </label>
                                  <div class="file-select">
                                    <input
                                      onChange={this.handleChange12}
                                      type="file"
                                      id="attachment1"
                                    />
                                    <label name="attachment" for="attachment1">
                                      <img src={File} alt="" />
                                      <span class="status">Upload status</span>
                                      <ProgressBar now={this.state.loaded1} />
                                    </label>
                                    <small class="form-text text-muted">
                                      {t(
                                        "c_material_list.request.attachment_text"
                                      )}
                                    </small>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label>
                                {t("c_material_list.request.product_images")}
                              </label>
                              <div class="row">
                                <div class="col-xl-10">
                                  <div class="row gutters-14">
                                    <div class="col-lg-3 col-sm-4 col-6">
                                      <div
                                        class="file-select"
                                        style={
                                          this.state.slider_image_err === true
                                            ? { border: "1px solid #eb516d" }
                                            : {}
                                        }
                                      >
                                        <input
                                          onChange={this.handleChange13}
                                          multiple
                                          name="slider_image[]"
                                          type="file"
                                          id="file5"
                                        />
                                        <label for="file1">
                                          {this.fileArray.length <= 0 ? (
                                            <img src={File} alt="..." />
                                          ) : (
                                            this.fileArray.map((url) => (
                                              <div>
                                                <img
                                                  style={{ height: "100px" }}
                                                  src={
                                                    this.fileArray.length <= 0
                                                      ? File
                                                      : url
                                                  }
                                                  alt="..."
                                                />
                                              </div>
                                            ))
                                          )}
                                          <span class="status">Upload</span>
                                          <ProgressBar
                                            now={this.state.loaded2}
                                          />
                                        </label>
                                        <small class="form-text text-muted">
                                          jpeg, png, jpg, gif, svg
                                        </small>
                                        {this.state.slider_image == "" ? (
                                          ""
                                        ) : (
                                          <button
                                            style={{ marginTop: "10px" }}
                                            onClick={this.removeImg}
                                            class="btn btn-danger"
                                          >
                                            Remove
                                          </button>
                                        )}
                                        <small
                                          class="form-text text-muted"
                                          style={{
                                            fontSize: "13px",
                                            marginTop: "10px",
                                          }}
                                        >
                                          {t(
                                            "c_material_list.request.product_images_text"
                                          )}
                                        </small>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-lg-12">
                            <div class="form-group">
                              <label class="d-none d-xl-block">&nbsp;</label>
                              <div class="clear"></div>
                              {loading ? (
                                loading
                              ) : (
                                <button
                                  onClick={this.handleSubmit1}
                                  class="btn btn-success"
                                >
                                  Submit
                                </button>
                              )}
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(Createworklist);
