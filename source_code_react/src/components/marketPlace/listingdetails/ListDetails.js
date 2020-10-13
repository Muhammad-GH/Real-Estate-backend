import React, { Component } from "react";
import axios from "axios";
import Header from "../../shared/Header";
import Sidebar from "../../shared/Sidebar";
import Avatar from "../../../images/avatar4.jpg";
import { Helper, url } from "../../../helper/helper";
import Accept from "./Modals/Accept";
import Decline from "./Modals/Decline";
import Carousel from "react-bootstrap/Carousel";
import Alert from "react-bootstrap/Alert";
import Spinner from "react-bootstrap/Spinner";
import { withTranslation } from "react-i18next";

class ListDetails extends Component {
  state = {
    detail: [],
    slider: [],
    imgs: [],
    bids: [],
    deleted: false,
    loaded: false,

    left: null,
    right: null,
  };

  componentDidMount = () => {
    this.loadData();
    this.loadBids();
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

  loadData = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/material-offer-detail/${this.props.match.params.id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const { data } = result;
        this.setState({ detail: data[0] });
        this.setState(
          {
            slider: this.state.detail.tender_slider_images,
          },
          () => {
            const vals = Object.values(this.state.slider);
            this.setState({ imgs: vals });
          }
        );
      })
      .catch((err) => {
        const { history } = this.props;
        history.push("/feeds");
      });
  };

  loadBids = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/bid/${this.props.match.params.id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ bids: result.data.data, loaded: true });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  handleDelete = async (id) => {
    const token = await localStorage.getItem("token");
    const response = await axios.delete(`${url}/api/list-detail/remove/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    if (response.status === 200) {
      this.setState({ deleted: true });
    }
  };

  render() {
    const { t, i18n } = this.props;

    let alert;
    if (this.state.deleted === true) {
      alert = (
        <Alert variant="success" style={{ fontSize: "13px" }}>
          Deleted
        </Alert>
      );
    }

    return (
      <div>
        <Header />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item active" aria-current="page">
              {t("header.marketplace")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {this.state.detail.tender_category_type}{" "}
              {this.state.detail.tender_type}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            {alert ? alert : null}
            <div className="container-fluid">
              <h3 className="head3">
                {this.state.detail.tender_category_type}{" "}
                {this.state.detail.tender_type}
              </h3>
              <div className="card">
                <div className="card-body">
                  <div className="mt-4"></div>
                  <div style={{ maxWidth: "1145px" }}>
                    <div className="row gutters-60">
                      <div className="col-xl-4 col-lg-5">
                        <Carousel className="slider">
                          {this.state.imgs.map((img, index) => (
                            <Carousel.Item key={index}>
                              <img
                                src={
                                  url + "/images/marketplace/material/" + img
                                }
                                alt="First slide"
                              />
                            </Carousel.Item>
                          ))}
                        </Carousel>
                      </div>
                      <div className="col-xl-8 col-lg-7">
                        <div className="mt-2"></div>
                        <div className="details-content">
                          <div className="head">
                            <a href="#" className="btn-edit">
                              Edit<i className="icon-edit"></i>
                            </a>
                            <h4>{this.state.detail.tender_title}</h4>
                            <p>{this.state.detail.tender_type}</p>
                          </div>
                          <p>{this.state.detail.tender_description}</p>
                          <p>
                            Category
                            <a href="#" className="badge">
                              {this.state.detail.category}
                            </a>
                          </p>
                          <a
                            href={
                              url +
                              "/images/marketplace/material/" +
                              this.state.detail.tender_attachment
                            }
                            target="_blank"
                            class="attachment"
                          >
                            <i className="icon-paperclip"></i>
                            {this.state.detail.tender_attachment}
                          </a>
                          <table>
                            <tr>
                              <th>
                                {this.state.detail.tender_budget
                                  ? t("list_details.budget")
                                  : t("list_details.quantity")}
                              </th>
                              <td>
                                {this.state.detail.tender_budget
                                  ? this.state.detail.tender_budget
                                  : this.state.detail.tender_quantity}
                              </td>
                            </tr>
                            <tr>
                              <th>
                                {this.state.detail.tender_rate
                                  ? t("list_details.rate")
                                  : t("invoice.unit")}
                              </th>
                              <td>
                                {this.state.left}
                                {this.state.detail.tender_rate
                                  ? this.state.detail.tender_rate
                                  : this.state.detail.tender_unit}
                                {this.state.left}
                              </td>
                            </tr>
                            <tr>
                              <th>{t("list_details.location")}</th>
                              <td>
                                {this.state.detail.tender_pincode}{" "}
                                {this.state.detail.tender_city}
                              </td>
                            </tr>
                            {this.state.detail.extra === 2 ? (
                              <tr>
                                <th>{t("list_details.work")}</th>
                                <td>{t("list_details.included")}</td>
                              </tr>
                            ) : this.state.detail.extra === 1 ? (
                              <tr>
                                <th>{t("feeds.search.material")}</th>
                                <td>{t("list_details.included")}</td>
                              </tr>
                            ) : null}
                            <tr>
                              <th>
                                {this.state.detail.tender_available_from
                                  ? t("c_work_list.work_start")
                                  : null}
                              </th>
                              <td>
                                {this.state.detail.tender_available_from
                                  ? this.state.detail.tender_available_from
                                  : null}
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                    <br />
                    <br />
                    <br />
                    <button
                      onClick={(e) =>
                        this.handleDelete(this.state.detail.tender_id)
                      }
                      className="btn btn-light"
                    >
                      <i className="icon-trash"></i>Delete
                    </button>
                    <div class="hr mg-30"></div>
                    <h3>Bids on job</h3>
                    <div
                      class="table-responsive-lg"
                      style={{ maxWidth: "870px" }}
                    >
                      <table class="table table-noborder">
                        <tbody>
                          {this.state.loaded === true &&
                          this.state.bids.length === 0 ? (
                            <h3>No bids yet</h3>
                          ) : this.state.loaded === false ? (
                            <Spinner animation="border" role="status">
                              <span className="sr-only">Loading...</span>
                            </Spinner>
                          ) : (
                            this.state.bids.map((bid, index) => (
                              <tr key={index}>
                                <td>
                                  <div class="profile flex">
                                    <img src={Avatar} />
                                    <div class="content">
                                      <h4>{bid.full_name}</h4>
                                      <p>Designation/short intro</p>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <strong>
                                    {this.state.left}
                                    {bid.tb_quote}
                                    {this.state.right}
                                  </strong>
                                </td>
                                <td style={{ width: "140px" }}>
                                  <Accept
                                    key={index}
                                    id={this.props.match.params.id}
                                    avatar={Avatar}
                                    left={this.state.left}
                                    right={this.state.right}
                                  />
                                  <a
                                    href="#"
                                    class="btn btn-outline-dark open-AcceptDialog"
                                    data-user_id={bid.tb_user_id}
                                    data-id={bid.full_name}
                                    data-bid={bid.tb_quote}
                                    data-toggle="modal"
                                    data-target="#accept"
                                  >
                                    Accept
                                  </a>
                                </td>
                                <td style={{ width: "140px" }}>
                                  <Decline id={this.props.match.params.id} />
                                  <a
                                    href="#"
                                    class="btn btn-gray open-DeclineDialog"
                                    data-user_id={bid.tb_user_id}
                                    data-toggle="modal"
                                    data-target="#decline"
                                  >
                                    Decline
                                  </a>
                                </td>
                              </tr>
                            ))
                          )}
                        </tbody>
                      </table>
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

export default withTranslation()(ListDetails);
