import React, { Component, useState } from "react";
import axios from "axios";
import { Redirect } from "react-router-dom";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import File from "../../images/file-icon.png";
import { Helper, url } from "../../helper/helper";
import Alert from "react-bootstrap/Alert";
import { withTranslation } from "react-i18next";
import Spinner from "react-bootstrap/Spinner";
import ProgressBar from "react-bootstrap/ProgressBar";
import Datetime from "react-datetime";

class Createmateriallist extends Component {
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
      quantity: "",
      quantity_err: false,
      unit: "",
      unit_err: false,
      city: "",
      states: [],
      city_err: false,
      cost_per_unit: "",
      cost_per_unit_err: false,
      warranty: "",
      warranty_err: false,
      warranty_type: 1,
      pincode: "",
      pincode_err: false,
      post_expiry_date: "",
      post_expiry_date_err: false,
      description: "",
      description_err: "",
      featured_image: null,
      featured_image_err: null,
      attachment: null,
      attachment_err: null,
      slider_image: [],
      slider_image_err: false,
      attachment_preview: null,
      slider_image_preview: [null],
      delivery_type: [],
      delivery_cost: [],
      delivery_type_err: false,
      delivery_cost_err: false,
      checked: false,
      work_checked: 0,
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
        this.setState({ productcat: result.data.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
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
  handleChange13 = (event) => {
    this.setState({ delivery_type: event.target.value });
  };
  handleChange15 = (event) => {
    this.setState({ cost_per_unit: event.target.value });
  };
  handleChange16 = (event) => {
    this.setState({ delivery_cost: event.target.value });
  };
  handleChange3 = (event) => {
    this.setState({ quantity: event.target.value });
  };
  handleChange4 = (event) => {
    this.setState({ unit: event.target.value });
  };
  handleChange5 = (event) => {
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
  handleChange6 = (event) => {
    this.setState({ pincode: event.target.value });
  };
  handleChange14 = (event) => {
    this.setState({ warranty: event.target.value });
  };
  handleChange7 = (event) => {
    this.setState({ post_expiry_date: event._d });
  };
  handleChange8 = (event) => {
    this.setState({ description: event.target.value });
  };
  handleChange9 = (event) => {
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
  handleChange10 = (event) => {
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

  handleChange11 = (event) => {
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
        this.setState({ work_checked: 2 });
      }
    });
  };

  // material request
  handleSubmit = async (event) => {
    event.preventDefault();
    this.setState({
      title_err: false,
      quantity_err: false,
      pincode_err: false,
      post_expiry_date_err: false,
      description_err: false,
      categoryId_err: false,
      unit_err: false,
      city_err: false,
      featured_image_err: false,
      attachment_err: false,
      slider_image_err: false,
      cost_per_unit_err: false,
      delivery_type_err: false,
      delivery_cost_err: false,
      warranty_err: false,
    });
    if (this.state.title.length <= 0) {
      this.setState({ title_err: true });
    }
    if (this.state.quantity.length <= 0) {
      this.setState({ quantity_err: true });
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
    if (this.state.categoryId == "--Select--" || this.state.categoryId == "") {
      this.setState({ categoryId_err: true });
    }
    if (this.state.unit == "select" || this.state.unit == "") {
      this.setState({ unit_err: true });
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
    if (this.state.cost_per_unit.length <= 0) {
      this.setState({ cost_per_unit_err: true });
    }
    if (
      this.state.delivery_type == "--Select--" ||
      this.state.delivery_type == ""
    ) {
      this.setState({ delivery_type_err: true });
    }
    if (this.state.delivery_cost.length <= 0) {
      this.setState({ delivery_cost_err: true });
    }
    if (this.state.warranty.length <= 0) {
      this.setState({ warranty_err: true });
    }
    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("title", this.state.title);
    data.set("categoryId", this.state.categoryId);
    data.set("quantity", this.state.quantity);
    data.set("description", this.state.description);
    data.set("unit", this.state.unit);
    data.set("city", this.state.city);
    data.set("pincode", this.state.pincode);
    data.set("extra", this.state.work_checked);
    data.set("post_expiry_date", this.state.post_expiry_date);
    data.append("featured_image", this.state.featured_image);
    data.append("attachment", this.state.attachment);

    for (const key of Object.keys(this.state.slider_image)) {
      data.append("slider_image[]", this.state.slider_image[key]);
    }

    axios
      .post(`${url}/api/material-request/create`, data, {
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
  };
  // material offer
  handleSubmit1 = async (event) => {
    event.preventDefault();
    this.setState({
      title_err: false,
      quantity_err: false,
      pincode_err: false,
      post_expiry_date_err: false,
      description_err: false,
      categoryId_err: false,
      unit_err: false,
      city_err: false,
      featured_image_err: false,
      attachment_err: false,
      slider_image_err: false,
      cost_per_unit_err: false,
      delivery_type_err: false,
      delivery_cost_err: false,
      warranty_err: false,
    });
    if (this.state.title.length <= 0) {
      this.setState({ title_err: true });
    }
    if (this.state.quantity.length <= 0) {
      this.setState({ quantity_err: true });
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
    if (this.state.categoryId == "--Select--" || this.state.categoryId == "") {
      this.setState({ categoryId_err: true });
    }
    if (this.state.unit == "select" || this.state.unit == "") {
      this.setState({ unit_err: true });
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
    if (this.state.cost_per_unit.length <= 0) {
      this.setState({ cost_per_unit_err: true });
    }
    if (
      this.state.delivery_type == "--Select--" ||
      this.state.delivery_type == ""
    ) {
      this.setState({ delivery_type_err: true });
    }
    if (this.state.delivery_cost.length <= 0) {
      this.setState({ delivery_cost_err: true });
    }
    if (this.state.warranty.length <= 0) {
      this.setState({ warranty_err: true });
    }
    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("title", this.state.title);
    data.set("categoryId", this.state.categoryId);
    data.set("quantity", this.state.quantity);
    data.set("description", this.state.description);
    data.set("unit", this.state.unit);
    data.set("cost_per_unit", this.state.cost_per_unit);
    data.set("warranty", this.state.warranty);
    data.set("delivery_type[]", this.state.delivery_type);
    data.set("delivery_cost[]", this.state.delivery_cost);
    data.set("city", this.state.city);
    data.set("pincode", this.state.pincode);
    data.set("extra", this.state.work_checked);
    data.set("post_expiry_date", this.state.post_expiry_date);
    data.append("featured_image", this.state.featured_image);
    data.append("attachment", this.state.attachment);

    for (const key of Object.keys(this.state.slider_image)) {
      data.append("slider_image[]", this.state.slider_image[key]);
    }
    axios
      .post(`${url}/api/material-offers/create`, data, {
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
          {t("success.mat_ins")}
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
              {t("c_material_list.request.title")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div ref={this.myRef} className="page-content">
            {alert ? alert : null}
            <div className="container">
              <h3 className="head3">{t("c_material_list.request.title")}</h3>
              <div class="card">
                <div class="card-body">
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
                                onChange={this.handleChange1}
                                name="title"
                                type="text"
                                className="form-control"
                                style={
                                  this.state.title_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                placeholder=""
                              />
                            </div>
                            <div class="form-group">
                              <label for="categoryId">
                                {t("c_material_list.request.category")}
                              </label>
                              <select
                                required
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
                                  <label for="quantity">
                                    {t("c_material_list.request.vol_need")}
                                  </label>
                                  <input
                                    onChange={this.handleChange3}
                                    style={
                                      this.state.quantity_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    name="quantity"
                                    id="quantity"
                                    type="text"
                                    class="form-control"
                                    placeholder="1500"
                                  />
                                </div>
                              </div>
                              <div class="col-4">
                                <div class="form-group">
                                  <label for="unit">
                                    {t("c_material_list.request.unit")}
                                  </label>
                                  <select
                                    onClick={this.handleChange4}
                                    style={
                                      this.state.unit_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    name="unit"
                                    id="unit"
                                    class="form-control"
                                  >
                                    <option>select</option>
                                    <option>Kg</option>
                                    <option>M2</option>
                                    <option>Liter</option>
                                    <option>Other</option>
                                  </select>
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
                                onClick={this.handleChange5}
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
                                onChange={this.handleChange6}
                                name="pincode"
                                style={
                                  this.state.pincode_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                id="pincode"
                                type="text"
                                class="form-control"
                                placeholder="140603"
                              />
                            </div>
                            <div class="form-group">
                              <label for="expires">
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
                                  onChange={(date) => this.handleChange7(date)}
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
                                  id="work"
                                  value="2"
                                  onChange={this.handleCheck}
                                />
                                <label
                                  className="form-check-label"
                                  htmlFor="work"
                                >
                                  {t("feeds.search.work")}
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
                                onChange={this.handleChange8}
                                name="description"
                                style={
                                  this.state.description_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
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
                                    style={
                                      this.state.featured_image_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    class="file-select"
                                  >
                                    <input
                                      onChange={this.handleChange9}
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
                                <div class="form-group">
                                  <label for="attachment">
                                    {t("c_material_list.request.attachment")}
                                  </label>
                                  <div
                                    class="file-select"
                                    style={
                                      this.state.attachment_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <input
                                      onChange={this.handleChange10}
                                      name="attachment"
                                      type="file"
                                      id="attachment"
                                    />
                                    <label for="attachment">
                                      <img src={File} />
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
                                          onChange={this.handleChange11}
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
                              <label for="category">
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
                              <div class="col-5">
                                <div
                                  class="form-group"
                                  style={{ width: "100px" }}
                                >
                                  <label for="unitCost">
                                    {t("c_material_list.offer.cost_unit")}
                                  </label>
                                  <div
                                    class="input-group"
                                    style={
                                      this.state.cost_per_unit_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <input
                                      onChange={this.handleChange15}
                                      name="cost_per_unit"
                                      id="unitCost"
                                      type="text"
                                      class="form-control"
                                      placeholder="1500"
                                    />
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">€</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-xl col-4">
                                <div class="form-group">
                                  <label for="unit1">
                                    {t("c_material_list.request.unit")}
                                  </label>
                                  <select
                                    style={
                                      this.state.unit_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    name="unit"
                                    onClick={this.handleChange4}
                                    id="unit1"
                                    class="form-control"
                                  >
                                    <option>select</option>
                                    <option>Kg</option>
                                    <option>M2</option>
                                    <option>Liter</option>
                                    <option>Other</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl col-sm-12">
                                <div class="form-group">
                                  <label for="quantity">
                                    {t("c_material_list.offer.quantity")}
                                  </label>
                                  <input
                                    style={
                                      this.state.quantity_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onChange={this.handleChange3}
                                    name="quantity"
                                    id="quantity"
                                    type="text"
                                    class="form-control"
                                    placeholder="1500"
                                  />
                                </div>
                              </div>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-xl-5 col-7">
                                <div class="form-group">
                                  <label for="dtype">
                                    {t("c_material_list.offer.delivery_type")}
                                  </label>
                                  <select
                                    style={
                                      this.state.delivery_type_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onChange={this.handleChange13}
                                    name="delivery_type[]"
                                    id="dtype"
                                    class="form-control"
                                  >
                                    <option>--Select--</option>
                                    <option>Road</option>
                                    <option>Flight</option>
                                    <option>Ship</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-xl col-5">
                                <div class="form-group">
                                  <label for="cost">
                                    {t("c_material_list.offer.cost")}
                                  </label>
                                  <input
                                    style={
                                      this.state.delivery_cost_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onChange={this.handleChange16}
                                    name="delivery_cost[]"
                                    id="cost"
                                    type="text"
                                    class="form-control"
                                    placeholder="1200"
                                  />
                                </div>
                              </div>
                              <div class="col-xl-3 col-lg-12">
                                <div class="form-group">
                                  <label class="d-none d-xl-block">
                                    &nbsp;
                                  </label>
                                  <div class="clear"></div>
                                  <button class="btn btn-success">Add</button>
                                </div>
                              </div>
                              <div class="col-12">
                                <ul class="list-striped">
                                  <li>Road- 1200</li>
                                  <li>Flight 1500</li>
                                  <li>Ship 1500</li>
                                </ul>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="expires1">
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
                                  onChange={(date) => this.handleChange7(date)}
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
                                  id="work1"
                                  onChange={this.handleCheck}
                                />
                                <label
                                  className="form-check-label"
                                  htmlFor="work1"
                                >
                                  Work
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
                                style={
                                  this.state.description_err === true
                                    ? { border: "1px solid #eb516d" }
                                    : {}
                                }
                                onChange={this.handleChange8}
                                name="description"
                                id="Desc"
                                class="form-control"
                              ></textarea>
                            </div>
                            <div class="row gutters-24">
                              <div class="col-xl-5 col-md-6">
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
                                      (
                                        { state_id, state_identifier },
                                        index
                                      ) => {
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
                                  <label for="city1">
                                    {t("c_material_list.request.city")}
                                  </label>
                                  <select
                                    style={
                                      this.state.city_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onClick={this.handleChange5}
                                    name="city"
                                    id="city1"
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
                              </div>
                              <div class="col-xl-5 col-md-6">
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
                                    onChange={this.handleChange6}
                                    name="pincode"
                                    id="pincode1"
                                    type="text"
                                    class="form-control"
                                    placeholder="140603"
                                  />
                                </div>
                              </div>
                              <div class="col-xl-5 col-md-6">
                                <div class="form-group">
                                  <label for="warranty">
                                    {t("c_material_list.offer.warranty")}
                                  </label>
                                  <input
                                    style={
                                      this.state.warranty_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                    onChange={this.handleChange14}
                                    name="warranty"
                                    id="warranty"
                                    type="text"
                                    class="form-control"
                                  />
                                </div>
                              </div>
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
                                      onChange={this.handleChange9}
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
                                <div class="form-group">
                                  <label for="attachment">
                                    {t("c_material_list.request.attachment")}
                                  </label>
                                  <div
                                    class="file-select"
                                    style={
                                      this.state.attachment_err === true
                                        ? { border: "1px solid #eb516d" }
                                        : {}
                                    }
                                  >
                                    <input
                                      onChange={this.handleChange10}
                                      name="attachment"
                                      type="file"
                                      id="attachment"
                                    />
                                    <label for="attachment">
                                      <img src={File} />
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
                                          onChange={this.handleChange11}
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
                                  onClick={this.handleSubmit1}
                                  class="btn btn-success"
                                >
                                  Submit
                                </button>
                              )}{" "}
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

export default withTranslation()(Createmateriallist);
