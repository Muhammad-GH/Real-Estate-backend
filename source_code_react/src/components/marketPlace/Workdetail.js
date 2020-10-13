import React, { Component } from "react";
import axios from "axios";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import { Helper, url } from "../../helper/helper";
import Carousel from "react-bootstrap/Carousel";
import Alert from "react-bootstrap/Alert";
import ProgressBar from "react-bootstrap/ProgressBar";
import { withTranslation } from "react-i18next";

class Workdetail extends Component {
  constructor(props) {
    super(props);
    this.state = {
      details: [],
      slider: [],
      imgs: [],
      active: null,
      tb_quote: null,
      tb_description: null,
      tb_quantity: 0.0,
      tb_city_id: 0,
      tb_delivery_type: "Road",
      tb_delivery_charges: 0.0,
      tb_warrenty: 0,
      tb_warrenty_type: "Days",
      attachment: null,
      featured_image: null,
      img_preview: null,
      loaded1: 0,
      loaded: 0,
      errors: [],
      show_errors: false,
      show_msg: false,
      saved: [],
      refresh: false,

      left: null,
      right: null,
    };
  }

  componentDidMount = () => {
    this.loadData();
    this.loadSaved();
    this.loadConfig();
  };

  loadConfig = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/config/currency`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const { left, right } = result.data;
        this.setState({ left, right });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  componentDidUpdate(prevProps, prevState) {
    if (prevState.refresh !== this.state.refresh) {
      this.loadData();
      this.loadSaved();
    }
  }

  handleSubmit = async (event) => {
    event.preventDefault();
    const token = await localStorage.getItem("token");
    const data = new FormData();
    data.set("tb_tender_id", this.props.match.params.id);
    data.set("tb_quote", this.state.tb_quote);
    data.set("tb_description", this.state.tb_description);
    data.set("tb_quantity", this.state.tb_quantity);
    data.set("tb_city_id", this.state.tb_city_id);
    data.set("tb_delivery_type", this.state.tb_delivery_type);
    data.set("tb_delivery_charges", this.state.tb_delivery_charges);
    data.set("tb_warrenty", this.state.tb_warrenty);
    data.set("tb_warrenty_type", this.state.tb_warrenty_type);
    data.append("attachment", this.state.attachment);
    // data.append("featured_image", this.state.featured_image);

    axios
      .post(`${url}/api/bid/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        console.log(result);
        this.setState({ show_msg: true });
      })
      .catch((err) => {
        console.log(err.response.data);
        this.setState({ show_errors: true });
      });
  };

  handleChange1 = (event) => {
    this.setState({ tb_quote: event.target.value });
  };
  handleChange2 = (event) => {
    this.setState({ tb_description: event.target.value });
  };
  handleChange3 = (event) => {
    if (event.target.files[0].size > 2097152) {
      return alert("cannot be more than 2 mb");
    }
    if (
      event.target.files[0].name.split(".").pop() == "pdf" ||
      event.target.files[0].name.split(".").pop() == "docx" ||
      event.target.files[0].name.split(".").pop() == "doc" ||
      event.target.files[0].name.split(".").pop() == "jpeg" ||
      event.target.files[0].name.split(".").pop() == "png" ||
      event.target.files[0].name.split(".").pop() == "jpg" ||
      event.target.files[0].name.split(".").pop() == "gif" ||
      event.target.files[0].name.split(".").pop() == "svg"
    ) {
      this.setState({ attachment: event.target.files[0], loaded1: 50 });
      if (this.state.loaded1 <= 100) {
        setTimeout(
          function () {
            this.setState({ loaded1: 100 });
          }.bind(this),
          2000
        ); // wait 2 seconds, then reset to false
      }
    } else {
      this.setState({ attachment: null });
      return alert("File type not supported");
    }
  };
  // handleChange4 = (event) => {
  //   this.setState({ featured_image: null });
  //   if (
  //     event.target.files[0].name.split(".").pop() == "jpeg" ||
  //     event.target.files[0].name.split(".").pop() == "png" ||
  //     event.target.files[0].name.split(".").pop() == "jpg" ||
  //     event.target.files[0].name.split(".").pop() == "gif" ||
  //     event.target.files[0].name.split(".").pop() == "svg"
  //   ) {
  //     this.setState({
  //       featured_image: event.target.files[0],
  //       loaded: 50,
  //       featured_image_err: false,
  //       img_preview: URL.createObjectURL(event.target.files[0]),
  //     });
  //     if (this.state.loaded <= 100) {
  //       setTimeout(
  //         function () {
  //           this.setState({ loaded: 100 });
  //         }.bind(this),
  //         2000
  //       ); // wait 2 seconds, then reset to false
  //     }
  //   } else {
  //     this.setState({ featured_image: null });
  //     alert("File type not supported");
  //   }
  // };

  loadSaved = async () => {
    const token = await localStorage.getItem("token");
    await axios
      .get(`${url}/api/saved-icon`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ saved: result.data.data });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  save = async (id) => {
    const token = await localStorage.getItem("token");
    const data = new FormData();
    data.set("uft_tender_id", id);
    axios
      .post(`${url}/api/saved/add`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ refresh: false });
        this.setState({ refresh: true });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  loadData = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/material-offer-detail/${this.props.match.params.id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        console.log(result.data[0]);
        this.setState({ details: result.data[0] });
        this.setState(
          {
            slider: this.state.details.tender_slider_images,
          },
          () => {
            const vals = Object.values(this.state.slider);
            this.setState({ imgs: vals });
          }
        );
      })
      .catch((err) => {
        console.log(err);
      });
  };

  render() {
    const { t, i18n } = this.props;

    let chunk, alert;
    if (this.state.show_errors === true) {
      alert = (
        <Alert variant="danger" style={{ fontSize: "13px" }}>
          {t("success.all_fields_are_required")}
        </Alert>
      );
    }
    if (this.state.show_msg === true) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          {t("success.work_bid")}
        </Alert>
      );
    }

    const values = Object.values(this.state.saved);
    const classname = (id) =>
      values.map((item) => {
        if (item.uft_tender_id === id) {
          return "icon-heart";
        }
      });

    if (this.state.details.tender_type === "Request") {
      chunk = (
        <div>
          <div class="form-group">
            <label for="delivery-charges">
              {t("list_details.delivery_charges")}
            </label>
            <input
              id="delivery-charges"
              class="form-control"
              type="text"
              placeholder="800"
            />
          </div>
          <div class="form-group">
            <label for="warranty">{t("list_details.warranty")}</label>
            <div class="d-flex input-group">
              <input
                id="warranty"
                class="form-control"
                type="text"
                placeholder="20"
              />
              <select class="form-control">
                <option>--Select--</option>
                <option>Days</option>
                <option>Months</option>
              </select>
            </div>
          </div>
        </div>
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
            <li className="breadcrumb-item active" aria-current="page">
              {this.state.details.tender_category_type}{" "}
              {this.state.details.tender_type} details
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar />
          <div class="page-content">
            {alert ? alert : null}
            <div class="container-fluid">
              <h3 class="head3">
                {this.state.details.tender_category_type}{" "}
                {this.state.details.tender_type} details
              </h3>
              <div class="card">
                <div class="card-body">
                  <div class="row details-view">
                    <div class="col-md">
                      <Carousel className="slider">
                        <Carousel.Item>
                          <img
                            className="d-block w-100"
                            src={
                              url +
                              "/images/marketplace/material/" +
                              this.state.details.tender_featured_image
                            }
                            alt="First slide"
                          />
                        </Carousel.Item>
                        {this.state.imgs.map((img) => (
                          <Carousel.Item>
                            <img
                              className="d-block w-100"
                              src={url + "/images/marketplace/material/" + img}
                              alt="First slide"
                            />
                          </Carousel.Item>
                        ))}
                      </Carousel>

                      <div class="details-content">
                        <div class="head">
                          <h4>{this.state.details.tender_title}</h4>
                          <p>{this.state.details.tender_type}</p>
                        </div>
                        <p>{this.state.details.tender_description}</p>
                        <p>
                          Category
                          <a href="#" class="badge">
                            {this.state.details.category}
                          </a>
                        </p>
                        <a
                          href={
                            url +
                            "/images/marketplace/material/" +
                            this.state.details.tender_attachment
                          }
                          target="_blank"
                          class="attachment"
                        >
                          <i class="icon-paperclip"></i>
                          {this.state.details.tender_attachment}
                        </a>
                        <table>
                          <tr>
                            <th>{t("list_details.budget")}</th>
                            <td>{this.state.details.tender_budget}</td>
                          </tr>

                          {this.state.details.tender_type === "Request" ? (
                            <tr>
                              <th>{t("list_details.rate")}</th>
                              <td>
                                {this.state.left}{" "}
                                {this.state.details.tender_rate}{" "}
                                {this.state.right}
                              </td>
                            </tr>
                          ) : (
                            ""
                          )}

                          <tr>
                            <th>{t("list_details.location")}</th>
                            <td>
                              {this.state.details.tender_pincode}{" "}
                              {this.state.details.tender_city}
                            </td>
                          </tr>

                          {this.state.details.tender_type === "Request" ? (
                            <tr>
                              <th>{t("c_work_list.work_start")}</th>
                              <td>
                                {this.state.details.tender_available_from}
                              </td>
                            </tr>
                          ) : (
                            ""
                          )}
                          {this.state.details.tender_type === "Request" ? (
                            <tr>
                              <th>{t("c_work_list.work_end")}</th>
                              <td>{this.state.details.tender_available_to}</td>
                            </tr>
                          ) : (
                            <tr>
                              <th>{t("c_work_list.availablity")}</th>
                              <td>
                                {this.state.details.tender_available_from} -{" "}
                                {this.state.details.tender_available_to}
                              </td>
                            </tr>
                          )}

                          {this.state.details.extra === 1 ? (
                            <tr>
                              <th>{t("feeds.search.material")}</th>
                              <td>{t("list_details.included")}</td>
                            </tr>
                          ) : (
                            ""
                          )}

                          <tr>
                            <th>{t("list_details.expires_in")}</th>
                            <td>{this.state.details.tender_expiry_date}</td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="details-form">
                        <form onSubmit={this.handleSubmit}>
                          <div class="form-group">
                            <div class="row align-items-center">
                              <div class="col-5">
                                <label class="d-flex ">
                                  {t("list_details.your_quote")}
                                </label>
                              </div>
                              <div class="col-7">
                                <label class="d-flex align-items-center">
                                  {this.state.left}
                                  {this.state.right}/
                                  {this.state.details.tender_budget}{" "}
                                  <input
                                    onChange={this.handleChange1}
                                    class="form-control"
                                    type="text"
                                  />
                                </label>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="message">
                              {t("list_details.message")}:
                            </label>
                            <textarea
                              onChange={this.handleChange2}
                              id="message"
                              class="form-control"
                            ></textarea>
                          </div>
                          <div class="form-group">
                            <label for="attachment">
                              {t("c_material_list.request.attachment")}
                            </label>
                            <div class="file-select">
                              <input
                                onChange={this.handleChange3}
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
                                Max 2 mb pdf, doc, jpeg, png, jpg, gif, svg
                              </small>
                            </div>
                          </div>
                          {/* <div class="form-group">
                            <label for="main">{t("list_details.image")}</label>
                            <div class="file-select">
                              <input
                                onChange={this.handleChange4}
                                name="featured_image"
                                type="file"
                                id="main"
                              />
                              <label for="main">
                                <img
                                  src={
                                    this.state.img_preview
                                      ? this.state.img_preview
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
                          </div> */}
                          <div class="form-group">
                            <div class="form-check">
                              <input
                                type="checkbox"
                                class="form-check-input"
                                id="terms"
                              />
                              <label class="form-check-label" for="terms">
                                {t("list_details.i_agree_all")}{" "}
                                <a href="#">
                                  {t("list_details.terms_of_service")}
                                </a>
                              </label>
                            </div>
                          </div>

                          <button class="btn btn-secondary" type="submit">
                            Submit your bid
                          </button>
                          <button
                            onClick={(e) => {
                              e.preventDefault();
                              this.save(this.state.details.tender_id);
                            }}
                            class="btn btn-light"
                            type="submit"
                          >
                            <i
                              class={
                                classname(this.state.details.tender_id).filter(
                                  function (el) {
                                    return el;
                                  }
                                ) == "icon-heart"
                                  ? "icon-heart"
                                  : "icon-heart-o"
                              }
                            ></i>
                            Save this job
                          </button>
                        </form>
                      </div>
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

export default withTranslation()(Workdetail);
