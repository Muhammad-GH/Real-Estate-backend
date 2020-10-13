import React, { Component } from "react";
import axios from "axios";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import Spinner from "react-bootstrap/Spinner";
import { Helper, url } from "../../helper/helper";
import { HashRouter as Router, Link } from "react-router-dom";
import { withTranslation } from "react-i18next";

class Savedjobs extends Component {
  constructor(props) {
    super(props);
    this.state = {
      jobs: [],
      removed: false,
      loaded: false,
    };
  }

  componentDidMount = () => {
    this.loadData();
  };

  componentDidUpdate(prevProps, prevState) {
    if (prevState.removed !== this.state.removed) {
      this.loadData();
    }
  }

  loadData = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/saved`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ jobs: result.data.data, loaded: true });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  remove = async (id) => {
    const token = await localStorage.getItem("token");
    await axios
      .delete(`${url}/api/saved/remove/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ removed: false });
        this.setState({ removed: true });
        // window.location.reload(false);
      })
      .catch((err) => {
        if (err.response.status === 404) {
          return alert("Saved job doesn't belong to the user");
        }
        return alert("Some issue occured");
      });
  };

  url(type, category) {
    if (category === "Material") {
      return "material-offer-detail";
    }
    if (category === "Work") {
      return "work-detail";
    }
    return null;
  }

  // Render Funtion
  render() {
    const { t, i18n } = this.props;
    let i = 1;

    return (
      <div>
        <Header active={"market"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item active" aria-current="page">
              {t("header.marketplace")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <Sidebar dataFromParent={this.props.location.pathname} />
          <div className="page-content">
            <div className="container-fluid">
              <div className="card">
                <div className="card-header">
                  <h2 className="head2">{t("feeds.saved_job")}</h2>
                </div>
                <div className="card-body">
                  <div className="feeds" style={{ maxWidth: "100%" }}>
                    {this.state.loaded === true &&
                    this.state.jobs.length <= 0 ? (
                      <Spinner animation="border" role="status">
                        <span className="sr-only">Loading...</span>
                      </Spinner>
                    ) : this.state.loaded === false &&
                      this.state.jobs.length <= 0 ? (
                      <div className="item">
                        <h3>No {t("feeds.saved_job")} </h3>
                      </div>
                    ) : (
                      this.state.jobs.map((feed) => (
                        <div className="item" key={feed[0].tender_id}>
                          <div className="img-box">
                            <img
                              src={`${url}/images/marketplace/material/${feed[0].tender_featured_image}`}
                              alt="featured"
                            />
                          </div>
                          <div className="content-box">
                            <h3>
                              <Link
                                to={{
                                  pathname: `/${this.url(
                                    feed[0].tender_type,
                                    feed[0].tender_category_type
                                  )}/${feed[0].tender_id}`,
                                }}
                                style={{
                                  textDecoration: "none",
                                  color: "black",
                                }}
                              >
                                {feed[0].tender_title}
                              </Link>
                            </h3>
                            <p>{feed[0].tender_description}.</p>
                            <p className="m-0">
                              <span className="badge badge-secondary">
                                {feed[0].tender_type}
                              </span>
                              <span className="badge badge-secondary">
                                {feed[0].tender_category_type}
                              </span>
                              <span className="badge badge-secondary">
                                {feed[0].extra === 2
                                  ? "Work included"
                                  : feed[0].extra === 1
                                  ? "Material included"
                                  : null}
                              </span>
                            </p>
                            <ul>
                              <li>
                                <span className="cl-light">Budget</span>
                                <span>{feed[0].tender_budget}€/pcs</span>
                              </li>
                              <li>
                                <span className="cl-light">qnt.</span>
                                <span>
                                  {feed[0].tender_quantity
                                    ? feed[0].tender_quantity
                                    : feed[0].tender_rate}
                                </span>
                              </li>
                              <li>
                                <span className="cl-light">Time left</span>
                                <span>
                                  {feed[0].tender_expiry_date.substring(0, 24)}
                                </span>
                              </li>
                            </ul>
                            <a
                              id={feed[0].tender_id}
                              onClick={() => this.remove(feed[0].tender_id)}
                              className="add-favorites"
                            >
                              <i class="icon-heart"></i>
                            </a>
                          </div>
                        </div>
                      ))
                    )}
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

export default withTranslation()(Savedjobs);
