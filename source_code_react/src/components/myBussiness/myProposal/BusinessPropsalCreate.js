import React, { Component } from "react";
import axios from "axios";
import { Helper, url } from "../../../helper/helper";
import Header from "../../shared/Header";
import BussinessSidebar from "../../shared/BussinessSidebar";
import File from "../../../images/file-icon.png";
import Datetime from "react-datetime";
import moment from "moment";
import BusinessInfo from "../modals/BusinessInfo";
import ProjectPlanProposal from "../modals/ProjectPlanProposal";
import PDFView from "../modals/PDFView";
import Select from "react-select";
import Alert from "react-bootstrap/Alert";
import Spinner from "react-bootstrap/Spinner";
import { withTranslation } from "react-i18next";

const options = [];
const clients = [];

class BusinessPropsalCreate extends Component {
  state = {
    logo: null,
    attachment: null,
    attachment_pre: null,
    logo_preview: null,
    customer: "",
    email: "",
    emails: [],
    date: "",
    mat_pay: "",
    other: "",
    work_pay: "",
    work: "",
    insurance: "",
    due_date: "",
    sdate: "",
    edate: "",
    business_info: [],
    error: null,
    name: null,

    errors: [],
    show_errors: false,
    show_msg: false,
    loading: false,

    tender_id: 0,
    proposal_id: 0,
    selectedOption: null,
    userEmail: null,
    client_id: null,

    type: "all",

    workItems: null,
    workTotal: 0,
    matItems: null,
    matTotal: 0,
    work_template_name: "",
    mat_template_name: "",
    template_name: "",
    mat_template_id: 0,
    work_template_id: 0,

    proposal_status: 0,
    proposal_client_type: 0,

    left: null,
    right: null,
  };

  componentDidMount = () => {
    if (this.props.match.params.customer !== undefined) {
      this.setState({ tender_id: this.props.match.params.tender });
      this.getEmail(this.props.match.params.customer);
    }
    if (
      this.props.match.params.customer !== undefined &&
      this.props.match.params.draft !== undefined
    ) {
      this.setData(this.props.match.params.tender);
    }
    this.loadResources();
    this.loadClient();
    this.loadProposalID();
    this.loadConfig();
    this.myRef = React.createRef();
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

  setData = async (id) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/proposal/get/byID/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        const {
          proposal_tender_id,
          work,
          mat,
          proposal_client_type,
          // proposal_client_id,
          // proposal_user_id,
          // proposal_request_id,
          // proposal_pdf,
          proposal_attachment,
          emails,
          date,
          proposal_material_payment,
          proposal_other,
          proposal_work_payment,
          proposal_work_guarantee,
          proposal_insurance,
          proposal_due_date,
          proposal_start_date,
          proposal_end_date,
          proposal_status,
          email,
          proposal_names,
        } = result.data[0];

        this.setState({
          tender_id: proposal_tender_id,
          emails: emails ? emails.split(",") : [],
          date,
          mat_pay: proposal_material_payment,
          other: proposal_other,
          work_pay: proposal_work_payment,
          work: proposal_work_guarantee,
          insurance: proposal_insurance,
          due_date: proposal_due_date,
          sdate: proposal_start_date,
          edate: proposal_end_date,
          userEmail: email,
          attachment_pre: proposal_attachment,
          name: proposal_names,

          matItems: mat.items,
          matTotal: mat.total,
          mat_template_name: mat.template_name,
          mat_template_id: mat.id,
          workItems: work.items,
          workTotal: work.total,
          work_template_name: work.template_name,
          work_template_id: work.id,

          proposal_status,
          proposal_client_type,
        });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  getEmail = async (id) => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/users/${id}`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        this.setState({ userEmail: result.data[0].email });
      })
      .catch((err) => {
        console.log(err);
      });
  };

  handleworkItems = (items, total, type, name, id) => {
    console.log(id);
    if (type == "Material") {
      this.setState({
        matItems: items,
        matTotal: total,
        mat_template_name: name,
        mat_template_id: id,
      });
    }
    if (type == "Work") {
      this.setState({
        workItems: items,
        workTotal: total,
        work_template_name: name,
        work_template_id: id,
      });
    }
  };

  loadProposalID = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/proposal/get/latest`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        if (
          Object.keys(result.data).length === 0 &&
          result.data.constructor === Object
        ) {
          this.setState({ proposal_id: 1 });
        } else {
          this.setState({ proposal_id: result.data.proposal_id + 1 });
        }
      })
      .catch((err) => {
        console.log(err);
      });
  };

  loadResources = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/resources-list`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        result.data.data.map((res) => {
          var keys = ["value", "label"];
          var _key = {};
          keys.forEach((key, i) => (_key[key] = res.email));
          options.push(_key);
        });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  loadClient = async () => {
    const token = await localStorage.getItem("token");
    axios
      .get(`${url}/api/resources-list/Client`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((result) => {
        result.data.data.map((res) => {
          var keys = ["value", "label"];
          var _key = {};
          keys.forEach((key, i) => (_key[key] = res.email));
          clients.push(_key);
        });
      })
      .catch((err) => {
        console.log(err.response);
      });
  };

  handleAuto = (selectedOption) => {
    this.setState({ selectedOption });
  };
  handleBusinessInfo = (val) => {
    this.setState({ business_info: val });

    this.setState({
      work: this.state.business_info.work,
      insurance: this.state.business_info.insurance,
    });
  };

  handleChange1 = (event) => {
    this.setState({ logo: null });
    if (
      event.target.files[0].name.split(".").pop() == "jpeg" ||
      event.target.files[0].name.split(".").pop() == "png" ||
      event.target.files[0].name.split(".").pop() == "jpg" ||
      event.target.files[0].name.split(".").pop() == "gif" ||
      event.target.files[0].name.split(".").pop() == "svg"
    ) {
      this.setState({
        logo: event.target.files[0],
        logo_preview: URL.createObjectURL(event.target.files[0]),
      });
    } else {
      this.setState({ logo: null });
      alert("File type not supported");
    }
  };
  handleChange7 = (event) => {
    if (event.target.files[0].size > 2097152) {
      return alert("cannot be more than 2 mb");
    }
    if (
      event.target.files[0].name.split(".").pop() == "pdf" ||
      event.target.files[0].name.split(".").pop() == "docx" ||
      event.target.files[0].name.split(".").pop() == "doc"
    ) {
      this.setState({ attachment: event.target.files[0] });
    } else {
      this.setState({ attachment: null });
      return alert("File type not supported");
    }
  };

  handleDelete = (item) => {
    this.setState({
      emails: this.state.emails.filter((i) => i !== item),
    });
  };

  handlePaste = (evt) => {
    evt.preventDefault();

    var paste = evt.clipboardData.getData("text");
    var emails = paste.match(/[\w\d\.-]+@[\w\d\.-]+\.[\w\d\.-]+/g);

    if (emails) {
      var toBeAdded = emails.filter((email) => !this.isInList(email));

      this.setState({
        emails: [...this.state.emails, ...toBeAdded],
      });
    }
  };

  isValid(email) {
    let error = null;

    if (this.isInList(email)) {
      error = `${email} has already been added.`;
    }

    if (!this.isEmail(email)) {
      error = `${email} is not a valid email address.`;
    }

    if (error) {
      this.setState({ error });

      return false;
    }

    return true;
  }

  isInList(email) {
    return this.state.emails.includes(email);
  }

  isEmail(email) {
    return /[\w\d\.-]+@[\w\d\.-]+\.[\w\d\.-]+/.test(email);
  }

  handleChange2 = (event) => {
    const { name, value } = event.target;
    this.setState({ [name]: value, error: null });
  };

  handleRes = ({ value }) => {
    this.setState({ email: value, error: null });
  };

  handleKeyDown = (evt) => {
    if (["Enter", "Tab", ","].includes(evt.key)) {
      evt.preventDefault();

      var email = this.state.email.trim();

      if (email && this.isValid(email)) {
        this.setState({
          emails: [...this.state.emails, this.state.email],
          email: "",
        });
      }
    }
  };

  handleChange3 = (event) => {
    this.setState({ date: moment(event._d).format("DD-MM-YYYY") });
  };
  handleChange4 = (event) => {
    this.setState({ due_date: moment(event._d).format("DD-MM-YYYY") });
  };
  handleChange5 = (event) => {
    this.setState({ sdate: moment(event._d).format("DD-MM-YYYY") });
  };
  handleChange6 = (event) => {
    this.setState({ edate: moment(event._d).format("DD-MM-YYYY") });
  };

  handleDraft = async (event) => {
    event.preventDefault();

    let client_id;
    if (
      this.state.tender_id !== 0 ||
      this.props.match.params.draft !== undefined
    ) {
      client_id = this.props.match.params.customer;
    } else {
      if (this.state.selectedOption === null) {
        return alert("please select a resource");
      }
      client_id = this.state.selectedOption.value;
    }

    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    // data.set('logo', this.state.logo)
    data.set("proposal_request_id", this.requestInput.value);
    data.set("proposal_tender_id", this.state.tender_id);
    data.set("proposal_client_id", client_id);
    data.set("emails", this.state.emails);
    data.set("date", this.state.date);
    data.set("proposal_material_payment", this.state.mat_pay);
    data.set("proposal_other", this.state.other);
    data.set("proposal_work_payment", this.state.work_pay);
    data.set("proposal_work_guarantee", this.state.work);
    data.set("proposal_insurance", this.state.insurance);
    data.set("proposal_due_date", this.state.due_date);
    data.set("proposal_start_date", this.state.sdate);
    data.set("proposal_end_date", this.state.edate);
    data.set("sent", 0);
    data.set("proposal_client_type", this.state.proposal_client_type);
    data.set("work_template_id", this.state.work_template_id);
    data.set("mat_template_id", this.state.mat_template_id);
    data.set("proposal_names", this.state.name);
    data.append("attachment", this.state.attachment);
    axios
      .post(`${url}/api/proposal/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
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
    for (var pair of data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  };

  handleUpdate = async (event) => {
    event.preventDefault();
    let client_id =
      this.props.match.params.draft !== undefined
        ? this.props.match.params.customer
        : this.state.selectedOption.value;

    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("proposal_request_id", this.requestInput.value);
    data.set("proposal_tender_id", this.state.tender_id);
    data.set("proposal_client_id", client_id);
    data.set("emails", this.state.emails);
    data.set("date", this.state.date);
    data.set("proposal_material_payment", this.state.mat_pay);
    data.set("proposal_other", this.state.other);
    data.set("proposal_work_payment", this.state.work_pay);
    data.set("proposal_work_guarantee", this.state.work);
    data.set("proposal_insurance", this.state.insurance);
    data.set("proposal_due_date", this.state.due_date);
    data.set("proposal_start_date", this.state.sdate);
    data.set("proposal_end_date", this.state.edate);
    data.set("proposal_client_type", this.state.proposal_client_type);
    data.set("work_template_id", this.state.work_template_id);
    data.set("mat_template_id", this.state.mat_template_id);
    data.set("proposal_names", this.state.name);
    data.append("attachment", this.state.attachment);
    axios
      .post(`${url}/api/proposal/put`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
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
    for (var pair of data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  };

  handleSubmit = async (event) => {
    if (this.state.matItems === null || this.state.workItems === null) {
      return alert("Please select templates before submission");
    }
    // event.preventDefault();
    let client_id;
    if (
      this.state.tender_id !== 0 ||
      this.props.match.params.draft !== undefined
    ) {
      client_id = this.props.match.params.customer;
    } else {
      if (this.state.selectedOption === null) {
        return alert("please select a resource");
      }
      client_id = this.state.selectedOption.value;
    }

    const token = await localStorage.getItem("token");
    this.setState({ loading: true });
    const data = new FormData();
    data.set("proposal_request_id", this.requestInput.value);
    data.set("proposal_tender_id", this.state.tender_id);
    data.set("proposal_client_id", client_id);
    data.set("emails", this.state.emails);
    data.set("date", this.state.date);
    data.set("proposal_material_payment", this.state.mat_pay);
    data.set("proposal_other", this.state.other);
    data.set("proposal_work_payment", this.state.work_pay);
    data.set("proposal_work_guarantee", this.state.work);
    data.set("proposal_insurance", this.state.insurance);
    data.set("proposal_due_date", this.state.due_date);
    data.set("proposal_start_date", this.state.sdate);
    data.set("proposal_end_date", this.state.edate);
    data.set("sent", event);
    data.set("proposal_client_type", this.state.proposal_client_type);
    data.set("work_template_id", this.state.work_template_id);
    data.set("mat_template_id", this.state.mat_template_id);
    data.set("logo", this.state.business_info.company_logo);
    data.set("company_id", this.state.business_info.company_id);
    data.set(
      "names",
      `${this.state.business_info.first_name} ${this.state.business_info.last_name}`
    );
    data.set("email", this.state.business_info.email);
    data.set("address", this.state.business_info.address);
    data.set("phone", this.state.business_info.phone);
    data.set("bussiness_id", this.state.business_info.id);
    data.set("workTotal", this.state.workTotal);
    data.set("matTotal", this.state.matTotal);
    data.set(
      "matItems",
      JSON.parse(this.state.matItems).map((item) => item.items)
    );
    data.set(
      "workItems",
      JSON.parse(this.state.workItems).map((item) => item.items)
    );
    data.set("proposal_names", this.state.name);
    data.append("attachment", this.state.attachment);
    axios
      .post(`${url}/api/proposal/create`, data, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((res) => {
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
    for (var pair of data.entries()) {
      console.log(pair[0] + ", " + pair[1]);
    }
  };

  hiddenFields = () => {
    this.setState({
      client_id:
        this.state.tender_id !== 0 ||
        this.props.match.params.draft !== undefined
          ? this.state.userEmail
          : this.state.selectedOption.value,
    });
  };

  render() {
    const { t, i18n } = this.props;

    const userInfo = {
      client_id: this.state.client_id,
      proposal_id: this.state.proposal_id,
      date: this.state.date,
      due_date: this.state.due_date,
      workTotal: this.state.workTotal,
      matTotal: this.state.matTotal,
      mat_pay: this.state.mat_pay,
      work_pay: this.state.work_pay,
      matItems: this.state.matItems,
      workItems: this.state.workItems,
      work: this.state.work,
      insurance: this.state.insurance,
      start_date: this.state.sdate,
      end_date: this.state.edate,
      left: this.state.left,
      right: this.state.right,
    };

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
          {t("success.prop_ins")}
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

    const { selectedOption } = this.state;
    let req_id =
      this.props.match.params.draft === "update"
        ? this.props.match.params.tender
        : `${this.state.business_info.user_id}${this.state.proposal_id}`;

    return (
      <div>
        <Header active={"bussiness"} />
        <div className="sidebar-toggle"></div>
        <nav aria-label="breadcrumb">
          <ol className="breadcrumb">
            <li className="breadcrumb-item ">{t("mycustomer.heading")}</li>
            <li className="breadcrumb-item ">
              {t("b_sidebar.proposal.proposal")}
            </li>
            <li className="breadcrumb-item active" aria-current="page">
              {t("c_material_list.listing.create")}
            </li>
          </ol>
        </nav>
        <div className="main-content">
          <BussinessSidebar dataFromParent={this.props.location.pathname} />
          <div ref={this.myRef} className="page-content">
            {alert ? alert : null}
            <div className="container-fluid">
              <div
                className="d-md-flex justify-content-between"
                style={{ maxWidth: "1120px" }}
              >
                <h3 className="head3">{t("myproposal.cre_prop")}</h3>
                <div className="mt-md-n3 mt-sm-4 mb-sm-4 mb-md-0">
                  <button
                    onClick={this.hiddenFields}
                    className="btn btn-sm btn-gray mr-3 mb-3 mb-sm-0"
                    data-toggle="modal"
                    data-target="#preview-info"
                  >
                    Preview Proposal
                  </button>

                  {this.props.match.params.draft !== undefined ? (
                    <button
                      onClick={this.handleUpdate}
                      class="btn btn-sm btn-gray mr-3 mb-3 mb-sm-0"
                    >
                      Update as a draft
                    </button>
                  ) : loading ? (
                    loading
                  ) : (
                    <button
                      onClick={this.handleDraft}
                      class="btn btn-sm btn-gray mr-3 mb-3 mb-sm-0"
                    >
                      Save as a draft
                    </button>
                  )}

                  <button
                    onClick={this.handleSubmit}
                    className="btn btn-sm btn-primary mb-3 mb-sm-0"
                  >
                    Submit & Send
                  </button>
                </div>
              </div>
              <div className="card" style={{ maxWidth: "1120px" }}>
                <div className="card-body">
                  {/* <form> */}
                  <div className="row">
                    <div className="col-lg-5 col-md-6">
                      <div className="form-group">
                        <div className="file-select file-sel inline">
                          <label for="attachment1" style={{ width: "70%" }}>
                            <img
                              src={
                                this.state.business_info.company_logo === null
                                  ? File
                                  : url +
                                    "/images/marketplace/company_logo/" +
                                    this.state.business_info.company_logo
                              }
                              alt=""
                            />
                          </label>
                        </div>
                      </div>
                      <div className="form-group">
                        <label>
                          <a
                            data-toggle="collapse"
                            href="#business-info"
                            role="button"
                            aria-expanded="false"
                            aria-controls="business-info"
                          >
                            [+]
                          </a>{" "}
                          {t("myproposal.buss_info")}{" "}
                          <a
                            href="#"
                            data-toggle="modal"
                            data-target="#edit-info"
                          >
                            Edit
                          </a>
                        </label>
                        <div className="collapse" id="business-info">
                          <div className="form-detail">
                            <p>{this.state.business_info.company_id}</p>
                            <p>{`${this.state.business_info.first_name} ${this.state.business_info.last_name}`}</p>
                            <p></p>
                            <p>{this.state.business_info.email}</p>
                            <p>{this.state.business_info.company_website}</p>
                          </div>
                        </div>
                      </div>
                      <div className="form-group">
                        <label for="customer-info">
                          {t("myproposal.cus_info")}
                        </label>
                        {this.state.tender_id !== 0 ? (
                          <input
                            id="customer-info"
                            class="form-control"
                            type="text"
                            value={this.state.userEmail}
                            readOnly={true}
                          />
                        ) : this.props.match.params.draft !== undefined ? (
                          <input
                            id="customer-info"
                            class="form-control"
                            type="text"
                            value={this.state.userEmail}
                            readOnly={true}
                          />
                        ) : (
                          <Select
                            value={selectedOption}
                            onChange={this.handleAuto}
                            options={clients}
                          />
                        )}
                      </div>
                      <div className="form-group">
                        <label for="mails" style={{ marginRight: "60%" }}>
                          {t("myproposal.mail_multi")}
                        </label>
                        {this.state.emails.map((item) => (
                          <div className="tag-item" key={item}>
                            {item}
                            <button
                              type="button"
                              className="button"
                              onClick={() => this.handleDelete(item)}
                            >
                              &times;
                            </button>
                          </div>
                        ))}
                        <Select
                          // value={this.state.email}
                          onChange={this.handleRes}
                          options={options}
                          onKeyDown={this.handleKeyDown}
                          onPaste={this.handlePaste}
                        />
                        {/* <input
                          id="mails"
                          className="form-control"
                          type="text"
                          name="email"
                          value={this.state.email}
                          placeholder="Type or paste email addresses and press `Enter`..."
                          onKeyDown={this.handleKeyDown}
                          onChange={this.handleChange2}
                          onPaste={this.handlePaste}
                        /> */}
                        {this.state.error && (
                          <p className="error">{this.state.error}</p>
                        )}
                        <small className="form-text text-muted">
                          eg {t("myproposal.eg")}
                        </small>
                      </div>
                    </div>
                    <div className="col-lg-7 col-md-6">
                      <div className="form-group">
                        <label for="request-id">{t("myproposal.req_id")}</label>

                        <input
                          id="request-id"
                          className="form-control"
                          type="text"
                          ref={(input) => {
                            this.requestInput = input;
                          }}
                          value={req_id}
                          readOnly="readOnly"
                        />
                      </div>
                      <div className="form-group">
                        <label for="date">{t("myproposal.date")}</label>
                        <Datetime
                          onChange={(date) => this.handleChange3(date)}
                          id="date"
                          name="date"
                          dateFormat="DD-MM-YYYY"
                          timeFormat={false}
                          value={this.state.date}
                        />
                      </div>
                      <div className="form-group">
                        <label for="due-date">{t("myproposal.due_date")}</label>
                        <Datetime
                          onChange={(date) => this.handleChange4(date)}
                          id="due-date"
                          name="due-date"
                          dateFormat="DD-MM-YYYY"
                          timeFormat={false}
                          value={this.state.due_date}
                        />
                      </div>
                    </div>
                  </div>
                  <div className="mt-5"></div>
                  <div className="row">
                    <div className="col-lg-5 col-md-6">
                      <h2 className="head2 mb-5">
                        {t("myproposal.proposal_summary")}
                      </h2>
                      <div className="form-group">
                        <label>Total cost for bid</label>
                        <div className="form-detail">
                          <div className="row">
                            <div className="col">
                              <p>{t("myproposal.work_total")}</p>
                            </div>
                            <div className="col">
                              <p>
                                {this.state.left} {this.state.workTotal}{" "}
                                {this.state.right}
                              </p>
                            </div>
                          </div>
                          <div className="row">
                            <div className="col">
                              <p>{t("myproposal.material_total")}</p>
                            </div>
                            <div className="col">
                              <p>
                                {this.state.left} {this.state.matTotal}{" "}
                                {this.state.right}
                              </p>
                            </div>
                          </div>
                          <div className="row">
                            <div className="col">
                              <p>Total cost</p>
                            </div>
                            <div className="col">
                              <p>
                                {this.state.left}{" "}
                                {Number(this.state.workTotal) +
                                  Number(this.state.matTotal)}{" "}
                                {this.state.right}
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div className="form-group">
                        <label for="m-payment">{t("myproposal.mat_pay")}</label>
                        <select
                          value={this.state.mat_pay}
                          onChange={this.handleChange2}
                          name="mat_pay"
                          id="m-payment"
                          className="form-control"
                        >
                          <option>--Select--</option>
                          <option>Payment aftre total delivery</option>
                          <option>payment after project done</option>
                          <option>As per inovice</option>
                          <option value="other">Custom message</option>
                        </select>
                      </div>
                      <div
                        className="form-group"
                        id="custom-message"
                        style={{ display: "none" }}
                      >
                        <textarea
                          className="form-control"
                          onChange={this.handleChange2}
                          name="other"
                          value={this.state.other}
                          placeholder="Other message"
                        ></textarea>
                      </div>
                      <div className="form-group">
                        <label for="work-payment">
                          {t("myproposal.work_pay")}
                        </label>
                        <select
                          value={this.state.work_pay}
                          onChange={this.handleChange2}
                          name="work_pay"
                          id="work-payment"
                          className="form-control"
                        >
                          <option>--Select--</option>
                          <option>Payment aftre work</option>
                          <option>Payment aftre work</option>
                          <option>Payment aftre work</option>
                          <option>Pay hourly</option>
                        </select>
                      </div>
                    </div>
                    <div className="col-lg-7 col-md-6">
                      <h2 className="head2 mb-5">
                        {t("myproposal.project_plan")}
                      </h2>
                      <div className="form-group">
                        <div className="plan-list">
                          <div className="row gutters-24">
                            <div className="col-lg-6">
                              <button
                                className="btn btn-light add-plan"
                                data-toggle="modal"
                                data-target="#add-plan"
                                onClick={() => this.setState({ type: "Work" })}
                              >
                                {t("myproposal.work_cost")}
                              </button>
                            </div>
                            <div className="col-lg-6">
                              <button
                                className="btn btn-light add-plan"
                                data-toggle="modal"
                                data-target="#add-plan"
                                onClick={() =>
                                  this.setState({ type: "Material" })
                                }
                              >
                                {t("myproposal.mat_cost")}
                              </button>
                            </div>
                          </div>
                          <h3>
                            {t("feeds.search.work")}
                            <span
                              className="edit-plan"
                              data-toggle="modal"
                              data-target="#add-plan"
                              onClick={() =>
                                this.setState({
                                  template_name: this.state.work_template_name,
                                })
                              }
                            >
                              <i className="icon-edit"></i>
                            </span>
                          </h3>
                          <ul>
                            {this.state.workItems === null
                              ? null
                              : JSON.parse(this.state.workItems).map((item) => (
                                  <li>{item.items}</li>
                                ))}
                          </ul>
                          <h3>
                            {t("feeds.search.material")}
                            <span
                              className="edit-plan"
                              data-toggle="modal"
                              data-target="#add-plan"
                              onClick={() =>
                                this.setState({
                                  template_name: this.state.mat_template_name,
                                })
                              }
                            >
                              <i className="icon-edit"></i>
                            </span>
                          </h3>
                          <ul>
                            {this.state.matItems === null
                              ? null
                              : JSON.parse(this.state.matItems).map((item) => (
                                  <li>{item.items}</li>
                                ))}
                          </ul>
                          <span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div className="mt-5"></div>
                  <div className="row">
                    <div className="col-xl-12">
                      <h2 className="head2">
                        {t("myproposal.proposal_details")}
                      </h2>
                    </div>
                    <div className="col-xl-4 col-lg-5 col-md-6">
                      <div className="form-group">
                        <label for="work">
                          {t("myproposal.guarantees_for_work")}
                        </label>
                        <textarea
                          maxLength="162"
                          id="work"
                          onChange={this.handleChange2}
                          name="work"
                          value={this.state.work}
                          className="form-control"
                          placeholder="User can add open text here"
                        ></textarea>
                      </div>
                    </div>
                    <div className="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                      <div className="form-group">
                        <label for="insurance">
                          {t("myproposal.insurance")}
                        </label>
                        <textarea
                          maxLength="162"
                          id="insurance"
                          onChange={this.handleChange2}
                          name="insurance"
                          value={this.state.insurance}
                          className="form-control"
                          placeholder="User can add open text here"
                        ></textarea>
                      </div>
                    </div>
                    <div className="col-xl-4 col-lg-5 col-md-6">
                      <div className="row">
                        <div className="form-group col">
                          <label for="sdate">
                            {t("c_material_list.listing.start_date")}
                          </label>
                          <Datetime
                            onChange={(date) => this.handleChange5(date)}
                            id="sdate"
                            name="sdate"
                            dateFormat="DD-MM-YYYY"
                            timeFormat={false}
                            value={this.state.sdate}
                          />
                        </div>
                        <div className="form-group">
                          <label>&nbsp;</label>
                          <p className="saprator">to</p>
                        </div>
                        <div className="form-group col">
                          <label for="edate">
                            {t("c_material_list.listing.end_date")}
                          </label>
                          <Datetime
                            onChange={(date) => this.handleChange6(date)}
                            id="edate"
                            name="edate"
                            dateFormat="DD-MM-YYYY"
                            timeFormat={false}
                            value={this.state.edate}
                          />
                        </div>
                      </div>
                    </div>
                    <div className="col-xl-9 col-lg-10">
                      <div className="form-group">
                        <label for="issues">
                          {t("c_material_list.request.attachment")}
                        </label>
                        <div className="file-select inline">
                          <input
                            onChange={this.handleChange7}
                            type="file"
                            id="attachments"
                            name="attachments"
                          />
                          <label for="attachments">
                            <img src={File} alt="upload" />
                            <span className="status">Upload attachments</span>
                          </label>
                        </div>
                        {this.state.attachment_pre ? (
                          <label for="attachments">
                            <a
                              href={
                                url +
                                "/images/marketplace/proposal/" +
                                this.state.attachment_pre
                              }
                              target="_blank"
                              class="attachment"
                            >
                              <i class="icon-paperclip"></i>
                              {this.state.attachment_pre}
                            </a>
                          </label>
                        ) : null}
                      </div>
                    </div>
                  </div>
                  <div className="row">
                    <div className="form-group">
                      <label for="name">{t("myproposal.name")}</label>
                      <input
                        id="name"
                        className="form-control"
                        type="text"
                        name="name"
                        value={this.state.name}
                        onChange={this.handleChange2}
                        placeholder="Enter name"
                      />
                    </div>
                  </div>
                  <div className="mt-5"></div>
                  <div className="row">
                    <div className="col-12">
                      <button
                        onClick={this.hiddenFields}
                        className="btn btn-gray mb-md-0 mb-3 mr-4"
                        data-toggle="modal"
                        data-target="#preview-info"
                      >
                        Preview Proposal
                      </button>

                      {this.props.match.params.draft !== undefined ? (
                        <button
                          onClick={this.handleUpdate}
                          class="btn btn-sm btn-gray mr-3 mb-3 mb-sm-0"
                        >
                          Update as a draft
                        </button>
                      ) : loading ? (
                        loading
                      ) : (
                        <button
                          onClick={this.handleDraft}
                          class="btn btn-sm btn-gray mr-3 mb-3 mb-sm-0"
                        >
                          Save as a draft
                        </button>
                      )}

                      <button
                        onClick={() => this.handleSubmit(1)}
                        className="btn btn-sm btn-primary mb-3 mr-4 mb-sm-0"
                      >
                        Submit & Send
                      </button>
                    </div>
                  </div>
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                  <br />
                </div>
              </div>
            </div>

            <BusinessInfo onInfo={this.handleBusinessInfo} />
            <ProjectPlanProposal
              onSelectWorkTemplate={this.handleworkItems}
              tempName={this.state.template_name}
              onType={this.state.type}
              left={this.state.left}
              right={this.state.right}
            />

            <PDFView
              businessInfo={this.state.business_info}
              userInfo={userInfo}
            />
          </div>
        </div>
      </div>
    );
  }
}

export default withTranslation()(BusinessPropsalCreate);
