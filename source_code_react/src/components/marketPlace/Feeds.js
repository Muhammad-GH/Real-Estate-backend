import React, { Component, memo } from "react";
import axios from "axios";
import Header from "../shared/Header";
import Sidebar from "../shared/Sidebar";
import Spinner from "react-bootstrap/Spinner";
import { withTranslation } from "react-i18next";
import { Helper, url } from "../../helper/helper";
import { HashRouter as Router, Switch, Route, Link } from "react-router-dom";

class Feeds extends Component {
  feeds_search = [];
  _isMounted = false;

  constructor(props) {
    super(props);
    this.state = {
      feeds: [],
      productcat: [],
      cat: "",
      city: "",
      states: [],
      cities: [],
      search: null,
      checked: true,
      active: true,
      saved: [],
      ids: [],
      refresh: false,
      loaded: false,
    };
  }

  componentDidMount = () => {
    this._isMounted = true;
    this.axiosCancelSource = axios.CancelToken.source();

    this.loadData(this.axiosCancelSource);
    this.loadCategory(this.axiosCancelSource);
    this.loadSaved(this.axiosCancelSource);
    this.loadState(this.axiosCancelSource);
  };

  componentDidUpdate(prevProps, prevState) {
    if (prevState.refresh !== this.state.refresh) {
      this.loadData(this.axiosCancelSource);
      // this.loadCategory();
      this.loadSaved(this.axiosCancelSource);
    }
  }

  componentWillUnmount() {
    this._isMounted = false;
    this.axiosCancelSource.cancel();
  }

  loadState = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    let lang = await localStorage.getItem("i18nextLng");
    axios
      .get(`${url}/api/state/${lang}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((result) => {
        if (this._isMounted) {
          this.setState({ states: result.data.data });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          console.log(err.response);
        }
      });
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
        if (this._isMounted) {
          this.setState({ cities: result.data.data });
        }
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  loadSaved = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    await axios
      .get(`${url}/api/saved-icon`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((result) => {
        if (this._isMounted) {
          this.setState({ saved: result.data.data });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          console.log(err.response);
        }
      });
  };

  loadData = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/feeds`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((result) => {
        if (this._isMounted) {
          const feeds = result.data.data;
          this.feeds_search = feeds;
          this.setState({ feeds, loaded: true });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          alert("Error occured please login again");
        }
      });
  };

  loadCategory = async (axiosCancelSource) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/category`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        cancelToken: axiosCancelSource.token,
      })
      .then((result) => {
        if (this._isMounted) {
          this.setState({ productcat: result.data.data });
        }
      })
      .catch((err) => {
        if (axios.isCancel(err)) {
          console.log("Request canceled", err.message);
        } else {
          console.log(err.response);
        }
      });
  };

  searchSpace = (event) => {
    let keyword = event.target.value;
    this.setState({ search: keyword });
  };

  handleChange = (event) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ cat: event.target.value }, () => {
      if (this.state.cat == "--Select--") {
        window.location.reload();
      }
      this.setState((prevstate) => ({
        feeds: prevstate.feeds.filter((data) => {
          return data.category.includes(this.state.cat);
        }),
      }));
    });
    console.log(this.state.feeds);
  };

  handleCity = (event) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ city: event.target.value }, () => {
      if (this.state.city == "--Select--") {
        window.location.reload();
      }
      this.setState((prevstate) => ({
        feeds: prevstate.feeds.filter((data) => {
          return data.city.includes(this.state.city);
        }),
      }));
    });
  };

  handleCheck = (params) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ checked: !this.state.checked });
    if (this.state.checked) {
      this.setState({
        feeds: this.state.feeds.filter((data) => {
          return data.type.includes("Offer");
        }),
      });
    }
  };

  handleCheck1 = (params) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ checked: !this.state.checked });
    if (this.state.checked) {
      this.setState({
        feeds: this.state.feeds.filter((data) => {
          return data.type.includes("Request");
        }),
      });
    }
  };
  handleCheck2 = (params) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ checked: !this.state.checked });
    if (this.state.checked) {
      this.setState({
        feeds: this.state.feeds.filter((data) => {
          return data.category_type.includes("Material");
        }),
      });
    }
  };
  handleCheck3 = (params) => {
    this.setState({ feeds: this.feeds_search });
    this.setState({ checked: !this.state.checked });
    if (this.state.checked) {
      this.setState({
        feeds: this.state.feeds.filter((data) => {
          return data.category_type.includes("Work");
        }),
      });
    }
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
        this.setState({ refresh: false });
        this.setState({ refresh: true });
      })
      .catch((err) => {
        if (err.response.status === 404) {
          return alert("Saved job doesn't belong to the user");
        }
        return alert("Some issue occured");
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
        // window.location.reload(false);
      })
      .catch((err) => {
        console.log(err);
        alert("Some issue occured");
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

  budget(budget, cost_per_unit, unit) {
    if (budget !== null) {
      return "budget";
    }
    if (cost_per_unit !== null) {
      return "cost";
    }
    if (unit !== null) {
      return "unit";
    }
  }

  // Render Funtion
  render() {
    const { t, i18n } = this.props;

    let i = 1;

    const items = this.state.feeds.filter((data) => {
      if (this.state.search == null) {
        return data;
      } else if (
        data.title.toLowerCase().includes(this.state.search.toLowerCase()) ||
        data.description.toLowerCase().includes(this.state.search.toLowerCase())
      ) {
        return data;
      }
    });

    const values = Object.values(this.state.saved);
    const classname = (id) =>
      values.map((item) => {
        if (item.uft_tender_id === id) {
          return "icon-heart";
        }
      });

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
              <h3 className="head3">{t("feeds.search.title")}</h3>
              <div className="card">
                <div className="card-body">
                  <div className="filter">
                    <div className="row align-items-center">
                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <label htmlFor="product">
                            {t("feeds.search.product")}
                          </label>
                          <input
                            id="product"
                            onChange={(e) => this.searchSpace(e)}
                            type="text"
                            className="form-control"
                          />
                        </div>
                      </div>
                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <label htmlFor="productcat">
                            {t("feeds.search.product_category")}
                          </label>
                          <select
                            onChange={this.handleChange}
                            name="productcat"
                            id="productcat"
                            className="form-control"
                          >
                            <option>--Select--</option>
                            {this.state.productcat.map(
                              ({ category_id, category_name }, index) => (
                                <option value={category_name}>
                                  {category_name}
                                </option>
                              )
                            )}
                          </select>
                        </div>
                      </div>

                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <div className="form-check form-check-inline">
                            <input
                              onChange={this.handleCheck}
                              type="checkbox"
                              className="form-check-input"
                              id="exampleCheck1"
                            />
                            <label
                              className="form-check-label"
                              htmlFor="exampleCheck1"
                            >
                              {t("feeds.search.offer")}
                            </label>
                          </div>
                          <div className="form-check form-check-inline">
                            <input
                              onChange={this.handleCheck1}
                              type="checkbox"
                              className="form-check-input"
                              id="exampleCheck2"
                            />
                            <label
                              className="form-check-label"
                              htmlFor="exampleCheck2"
                            >
                              {t("feeds.search.request")}
                            </label>
                          </div>
                          <div className="form-check form-check-inline">
                            <input
                              onChange={this.handleCheck2}
                              type="checkbox"
                              className="form-check-input"
                              id="exampleCheck3"
                            />
                            <label
                              className="form-check-label"
                              htmlFor="exampleCheck3"
                            >
                              {t("feeds.search.material")}
                            </label>
                          </div>
                          <div className="form-check form-check-inline">
                            <input
                              onChange={this.handleCheck3}
                              type="checkbox"
                              className="form-check-input"
                              id="exampleCheck4"
                            />
                            <label
                              className="form-check-label"
                              htmlFor="exampleCheck4"
                            >
                              {t("feeds.search.work")}
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div className="row align-items-center">
                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <label htmlFor="productcat">
                            {" "}
                            {t("feeds.search.state")}
                          </label>
                          <select
                            onChange={this.ChangeCity}
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
                      </div>

                      <div className="col-lg-4 col-md-6">
                        <div className="form-group">
                          <label htmlFor="productcat">
                            {" "}
                            {t("feeds.search.city")}
                          </label>
                          <select
                            onChange={this.handleCity}
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
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-header">
                  <h2 className="head2">{t("sidebar.feeds")}</h2>
                </div>
                <div className="card-body">
                  <div className="feeds" style={{ maxWidth: "100%" }}>
                    {this.state.loaded === true && items.length === 0 ? (
                      <div className="item">
                        <h3>No jobs found</h3>
                      </div>
                    ) : this.state.loaded === false ? (
                      <Spinner animation="border" role="status">
                        <span className="sr-only">Loading...</span>
                      </Spinner>
                    ) : (
                      items.map((feed) => (
                        <div className="item" key={feed.id}>
                          <Link
                            to={{
                              pathname: `/${this.url(
                                feed.type,
                                feed.category_type
                              )}/${feed.id}`,
                            }}
                            style={{
                              textDecoration: "none",
                              color: "black",
                            }}
                          >
                            <div className="img-box">
                              <img
                                src={`${url}/images/marketplace/material/${feed.featured_image}`}
                                alt="featured"
                              />
                            </div>
                          </Link>

                          <div className="content-box">
                            <Link
                              to={{
                                pathname: `/${this.url(
                                  feed.type,
                                  feed.category_type
                                )}/${feed.id}`,
                              }}
                              style={{
                                textDecoration: "none",
                                color: "black",
                              }}
                            >
                              <h3>{feed.title}</h3>
                              <p>{feed.description}.</p>
                              <p className="m-0">
                                <span className="badge badge-secondary">
                                  {feed.type}
                                </span>
                                <span className="badge badge-secondary">
                                  {feed.category_type}
                                </span>
                                <span className="badge badge-secondary">
                                  {feed.extra === 2
                                    ? "Work included"
                                    : feed.extra === 1
                                    ? "Material included"
                                    : null}
                                </span>
                              </p>

                              <ul>
                                <li>
                                  <span className="cl-light">
                                    {this.budget(
                                      feed.budget,
                                      feed.cost_per_unit,
                                      feed.unit
                                    )}
                                  </span>
                                  <span className="cl-light">
                                    {feed.budget === "per_m2"
                                      ? "(cost/m2)"
                                      : feed.budget
                                      ? feed.budget
                                      : feed.cost_per_unit
                                      ? `${feed.cost_per_unit}€/pcs`
                                      : feed.unit}
                                    {/* {feed.budget === 'per_m2' ? 'cost/m2': '1'} */}
                                  </span>
                                </li>
                                <li>
                                  <span className="cl-light">qnt.</span>
                                  <span className="cl-light">
                                    {feed.quantity ? feed.quantity : feed.rate}
                                  </span>
                                </li>
                                <li>
                                  <span className="cl-light">Time left</span>
                                  <span className="cl-light">
                                    {feed.time_left}
                                  </span>
                                </li>
                              </ul>
                            </Link>
                            <a
                              id={feed.id}
                              className="add-favorites"
                              onClick={
                                classname(feed.id).filter(function (el) {
                                  return el;
                                }) == "icon-heart"
                                  ? () => this.remove(feed.id)
                                  : () => this.save(feed.id)
                              }
                            >
                              <i
                                className={
                                  classname(feed.id).filter(function (el) {
                                    return el;
                                  }) == "icon-heart"
                                    ? "icon-heart"
                                    : "icon-heart-o"
                                }
                              ></i>
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

export default withTranslation()(memo(Feeds));
