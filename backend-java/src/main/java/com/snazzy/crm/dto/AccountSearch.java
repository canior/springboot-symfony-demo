package com.snazzy.crm.dto;

import com.snazzy.crm.search.Search;
import lombok.Getter;
import lombok.Setter;

@Setter
@Getter
public class AccountSearch extends Search {
    private Boolean unassigned;
}
